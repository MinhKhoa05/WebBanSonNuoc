(function() {
  const lazyLoadElements = document.querySelectorAll(".lazy-load");

  lazyLoadElements.forEach((element) => {
    element.style.opacity = 0;
    element.style.transform = "translateY(30px)";
    element.style.transition = "all 0.8s ease-out";
  });

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      const { target } = entry;
      if (entry.isIntersecting) {
        target.style.opacity = 1;
        target.style.transform = "translateY(0)";
      }
    });
  }, {
    threshold: 1
  });

  lazyLoadElements.forEach((element) => {
    observer.observe(element);
  });
})();
