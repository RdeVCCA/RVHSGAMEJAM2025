document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.remove("paused");
      }
    });
  }, { threshold: 0.5 }); // Adjust the threshold as needed

  const observeElements = (elements) => {
    elements.forEach(el => {
      observer.observe(el);
    });
  };
  
  const paused = document.querySelectorAll('.paused');
  observeElements(paused);
});
  

