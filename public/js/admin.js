document.addEventListener('DOMContentLoaded', () => {
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('sidebar');
  if (sidebarToggle && sidebar) {
    sidebarToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      sidebar.classList.toggle('open');
    });

    document.addEventListener('click', (e) => {
      if (window.innerWidth > 768) return;
      if (!sidebar.classList.contains('open')) return;
      const target = e.target;
      if (sidebar.contains(target) || sidebarToggle.contains(target)) return;
      sidebar.classList.remove('open');
    });
  }

  // Sidebar Menu Filter Search
  const sidebarSearch = document.getElementById('sidebarSearch');
  const sidebarSearchClear = document.getElementById('sidebarSearchClear');
  const sidebarNav = document.getElementById('sidebarNav') || document.querySelector('.sidebar-nav');

  if (sidebarSearch && sidebarNav) {
    const filterSidebarMenu = () => {
      const query = (sidebarSearch.value || '').toLowerCase().trim();
      if (sidebarSearchClear) {
        sidebarSearchClear.style.display = query ? 'inline-block' : 'none';
      }

      const sections = sidebarNav.querySelectorAll('.sidebar-section');
      const links = sidebarNav.querySelectorAll('.sidebar-link');

      links.forEach(link => {
        const text = (link.textContent || '').toLowerCase();
        const searchKeywords = (link.getAttribute('data-search') || '').toLowerCase();
        const isMatch = !query || text.includes(query) || searchKeywords.includes(query);
        link.style.display = isMatch ? 'flex' : 'none';
      });

      sections.forEach(sec => {
        let next = sec.nextElementSibling;
        let hasVisibleLink = false;
        while (next && !next.classList.contains('sidebar-section')) {
          if (next.classList.contains('sidebar-link') && next.style.display !== 'none') {
            hasVisibleLink = true;
          }
          next = next.nextElementSibling;
        }
        sec.style.display = (!query || hasVisibleLink) ? 'block' : 'none';
      });
    };

    ['input', 'keyup', 'change', 'search', 'paste'].forEach(evt => {
      sidebarSearch.addEventListener(evt, filterSidebarMenu);
    });

    if (sidebarSearchClear) {
      sidebarSearchClear.addEventListener('click', (e) => {
        e.preventDefault();
        sidebarSearch.value = '';
        filterSidebarMenu();
        sidebarSearch.focus();
      });
    }
  }

  // SweetAlert alerts
  if (window.Swal) {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach((a) => {
      let type = 'info';
      if (a.classList.contains('alert-success')) type = 'success';
      if (a.classList.contains('alert-error')) type = 'error';
      if (a.classList.contains('alert-warning')) type = 'warning';
      if (a.classList.contains('alert-info')) type = 'info';
      const text = a.innerText.replace(/\s+/g, ' ').trim();
      Swal.fire({
        icon: type,
        title: type.charAt(0).toUpperCase() + type.slice(1),
        text,
        timer: 3000,
        showConfirmButton: false
      });
      a.remove();
    });
  }

  // SweetAlert confirm
  document.querySelectorAll('[data-confirm]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const message = btn.getAttribute('data-confirm') || 'Are you sure?';
      if (!window.Swal) return;
      e.preventDefault();
      Swal.fire({
        icon: 'warning',
        title: 'Confirm',
        text: message,
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          const form = btn.closest('form');
          if (form) {
            form.submit();
            return;
          }
          const href = btn.getAttribute('href');
          if (href) {
            window.location.href = href;
          }
        }
      });
    });
  });

  // Generic datatable (search + page size + pagination) for all admin tables
  document.querySelectorAll('main.admin-main .table-container table').forEach((table) => {
    table.classList.add('table-compact');
    const container = table.closest('.table-container');
    if (container) container.classList.add('table-sticky');

    const wrapper = table.closest('.card') || table.parentElement;
    const toolbar = document.createElement('div');
    toolbar.className = 'table-toolbar';

    const search = document.createElement('div');
    search.className = 'table-search';
    search.innerHTML = '<i class="fas fa-search"></i><input type="text" placeholder="Search...">';

    const pageSize = document.createElement('select');
    pageSize.className = 'table-select';
    pageSize.innerHTML = '<option value="10">10</option><option value="25">25</option><option value="50">50</option>';  

    toolbar.appendChild(search);
    toolbar.appendChild(pageSize);

    if (wrapper && !wrapper.querySelector('.table-toolbar')) {
      const header = wrapper.querySelector('.card-header');
      if (header) header.appendChild(toolbar);
      else wrapper.insertBefore(toolbar, wrapper.firstChild);
    }

    const footer = document.createElement('div');
    footer.className = 'table-footer';
    footer.innerHTML = '<div class="table-info">Showing 0 of 0</div><div class="table-pagination"><button class="btn btn-secondary btn-sm" data-prev>Prev</button><span class="table-info">1 / 1</span><button class="btn btn-secondary btn-sm" data-next>Next</button></div>';

    if (wrapper && !wrapper.querySelector('.table-footer')) {
      wrapper.appendChild(footer);
    }

    const tbody = table.querySelector('tbody');
    if (!tbody) return;
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const searchInput = search.querySelector('input');
    const info = footer.querySelector('.table-info');
    const pageInfo = footer.querySelector('.table-pagination .table-info');
    const prev = footer.querySelector('[data-prev]');
    const next = footer.querySelector('[data-next]');
    let page = 1;

    const apply = () => {
      const q = (searchInput.value || '').toLowerCase().trim();
      const size = parseInt(pageSize.value, 10);
      const filtered = rows.filter(r => r.innerText.toLowerCase().includes(q));
      const total = filtered.length;
      const pages = Math.max(1, Math.ceil(total / size));
      if (page > pages) page = pages;
      const start = (page - 1) * size;
      const end = start + size;

      rows.forEach(r => r.style.display = 'none');
      filtered.slice(start, end).forEach(r => r.style.display = '');

      info.textContent = `Showing ${total === 0 ? 0 : start + 1}-${Math.min(end, total)} of ${total}`;
      pageInfo.textContent = `${page} / ${pages}`;
      prev.disabled = page <= 1;
      next.disabled = page >= pages;
    };

    searchInput.addEventListener('input', () => { page = 1; apply(); });
    pageSize.addEventListener('change', () => { page = 1; apply(); });
    prev.addEventListener('click', () => { if (page > 1) { page--; apply(); } });
    next.addEventListener('click', () => { page++; apply(); });

    apply();
  });
});

