import './bootstrap';
import 'flowbite';


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




  
   


