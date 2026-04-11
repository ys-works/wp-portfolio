(function () {
  window.addEventListener("load", () => {
    const btnUp = document.getElementById("btn-up");
    const btnDown = document.getElementById("btn-down");
    const scrollTargets = document.querySelectorAll(
      "section, .panel, .news-list",
    );

    if (!btnUp || !btnDown) return;

    const handleNavButtons = () => {
      const scrollY = window.pageYOffset || document.documentElement.scrollTop;
      const windowH = window.innerHeight;
      const bodyH = document.documentElement.scrollHeight;

      if (scrollY <= 20) {
        btnUp.style.display = "none";
        btnDown.style.display = "block";
      } else if (scrollY + windowH >= bodyH - 20) {
        btnUp.style.display = "block";
        btnDown.style.display = "none";
      } else {
        btnUp.style.display = "block";
        btnDown.style.display = "block";
      }
    };

    btnDown.addEventListener("click", () => {
      for (let target of scrollTargets) {
        const rect = target.getBoundingClientRect();
        if (rect.top > 50) {
          window.scrollTo({
            top: window.pageYOffset + rect.top,
            behavior: "smooth",
          });
          break;
        }
      }
    });

    btnUp.addEventListener("click", () => {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    });

    window.addEventListener("scroll", handleNavButtons, { passive: true });
    handleNavButtons(); // 初期化
  });
})();
