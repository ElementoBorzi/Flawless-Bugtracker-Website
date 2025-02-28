// Check for saved theme in localStorage
const savedTheme = localStorage.getItem('theme') || 'light';
document.documentElement.setAttribute('data-bs-theme', savedTheme);

// Set switch position based on theme
const switcher = document.getElementById('themingSwitcher');
switcher.checked = savedTheme === 'dark';

// Add the event Listener
switcher.addEventListener('change', () => {
  const newTheme = switcher.checked ? 'dark' : 'light';
  document.documentElement.setAttribute('data-bs-theme', newTheme);
  localStorage.setItem('theme', newTheme);
});