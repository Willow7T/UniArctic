import './bootstrap';

function applyTheme(theme) {
  if (theme === 'dark') {
      document.documentElement.classList.remove('white');
      document.documentElement.classList.add('dark');
  } else {
      document.documentElement.classList.remove('dark');
      document.documentElement.classList.add('white');
  }
}

// Event listener for the switch
document.getElementById('darkswitch')?.addEventListener('change', function() {
  if (this.checked) {
      sessionStorage.setItem('theme', 'dark');
  } else {
      sessionStorage.setItem('theme', 'white');
  }
  applyTheme(sessionStorage.getItem('theme'));
});

// Apply the theme when the page loads
document.addEventListener('DOMContentLoaded', function() {
  applyTheme(sessionStorage.getItem('theme'));
});

window.previewDocxFileName = function(event) {
    var fileName = event.target.files[0].name;
    document.getElementById('contentPreview').innerText = fileName;
}
window.onload = function() {
  var savedTheme = sessionStorage.getItem('theme');
  if (savedTheme) {
    document.documentElement.className = savedTheme;
    document.getElementById('darkswitch').checked = (savedTheme == 'dark');
  }

 
};





  document.addEventListener('DOMContentLoaded', function() {
    var buttonMonth = document.querySelector('button[aria-controls="filter-section-mobile-0"]');
    var buttonYear = document.querySelector('button[aria-controls="filter-section-mobile-1"]');

    if (!buttonMonth || !buttonYear) {
        return;
    }
    // For "Month" section
    var buttonMonth = document.querySelector('button[aria-controls="filter-section-mobile-0"]');
    var filterSectionMonth = document.getElementById('filter-section-mobile-0');
    var expandIconMonth = buttonMonth.querySelector('.expand-icon');
    var collapseIconMonth = buttonMonth.querySelector('.collapse-icon');

    buttonMonth.addEventListener('click', function() {
        var isExpanded = filterSectionMonth.style.display === 'block';
        filterSectionMonth.style.display = isExpanded ? 'none' : 'block';
        expandIconMonth.style.display = isExpanded ? 'block' : 'none';
        collapseIconMonth.style.display = isExpanded ? 'none' : 'block';
    });

    // For "Year" section
    var buttonYear = document.querySelector('button[aria-controls="filter-section-mobile-1"]');
    var filterSectionYear = document.getElementById('filter-section-mobile-1');
    var expandIconYear = buttonYear.querySelector('.expand-icon');
    var collapseIconYear = buttonYear.querySelector('.collapse-icon');

    buttonYear.addEventListener('click', function() {
        var isExpanded = filterSectionYear.style.display === 'block';
        filterSectionYear.style.display = isExpanded ? 'none' : 'block';
        expandIconYear.style.display = isExpanded ? 'block' : 'none';
        collapseIconYear.style.display = isExpanded ? 'none' : 'block';
    });
});

