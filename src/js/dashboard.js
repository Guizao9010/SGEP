function dropdown() {
  document.querySelector("#submenu").classList.toggle("hidden");
  document.querySelector("#arrow").classList.toggle("rotate-0");
}
dropdown();

function openSidebar() {
  document.querySelector(".sidebar").classList.toggle("hidden");
}

// JavaScript to make the table header sticky on scroll
window.addEventListener('DOMContentLoaded', function () {
  var table = document.querySelector('table');
  var tableHeader = table.querySelector('thead');

  if (table && tableHeader) {
      var tableHeaderClone = tableHeader.cloneNode(true);
      tableHeaderClone.classList.add('sticky-header');
      tableHeaderClone.style.display = 'none';

      table.insertBefore(tableHeaderClone, table.firstChild);

      window.addEventListener('scroll', function () {
          if (window.innerWidth <= 768) {
              var scrollY = window.scrollY || window.pageYOffset;
              if (scrollY > table.offsetTop) {
                  tableHeaderClone.style.display = 'table-header-group';
              } else {
                  tableHeaderClone.style.display = 'none';
              }
          }
      });
  }
});
