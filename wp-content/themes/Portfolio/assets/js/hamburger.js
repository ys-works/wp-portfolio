document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.getElementById("hamburger");
  const navList = document.getElementById("nav-list");
  const bars = document.querySelectorAll(".bar");

  if (!hamburger || !navList) return;

  // --- 設定値 ---
  const breakpoint = 1200;
  const iconSize = 35;
  const barLength = 25;
  const barHeight = 2;
  const barGap = 6;

  // スタイルの適用
  function applyBaseStyles() {
    // #nav-list の基本スタイル
    navList.style.alignItems = "center";
    navList.style.gap = "10px";
    navList.style.margin = "0";
    navList.style.padding = "0";
    navList.style.listStyle = "none";
    navList.style.transition = "all 0.3s ease";

    // #hamburger の基本スタイル
    hamburger.style.width = iconSize + "px";
    hamburger.style.height = iconSize + "px";
    hamburger.style.cursor = "pointer";
    hamburger.style.flexDirection = "column";
    hamburger.style.justifyContent = "center";
    hamburger.style.alignItems = "center";
    hamburger.style.gap = barGap + "px";
    hamburger.style.padding = "0";
    hamburger.style.margin = "0";
    hamburger.style.border = "none";
    hamburger.style.background = "transparent";
    hamburger.style.zIndex = "1001";

    bars.forEach((bar) => {
      bar.style.display = "block";
      bar.style.width = barLength + "px";
      bar.style.height = barHeight + "px";
      bar.style.backgroundColor = "#000";
      bar.style.margin = "0";
      bar.style.transition = "all 0.3s ease";
      bar.style.transformOrigin = "center";
    });

    handleResize();
  }

  function handleResize() {
    const isMobile = window.innerWidth <= breakpoint;

    if (isMobile) {
      hamburger.style.display = "flex";
      hamburger.style.marginLeft = "auto";

      if (!isOpen) {
        navList.style.display = "none";
        resetMenuStyles();
      }
    } else {
      hamburger.style.display = "none";
      navList.style.display = "flex";
      isOpen = false;
      setHamburgerState(false);
      resetMenuStyles();
    }
  }

  // メニュー展開スタイル
  const activeMenuStyles = {
    display: "flex",
    flexDirection: "column",
    position: "fixed",
    top: "64px",
    right: "0",
    width: "250px",
    height: "calc(100vh - 64px)",
    background: "#ffffff",
    zIndex: "1000",
    padding: "20px",
    boxShadow: "-2px 0 5px rgba(0,0,0,0.1)",
    gap: "10px",
    alignItems: "flex-start",
  };

  function resetMenuStyles() {
    for (const key in activeMenuStyles) {
      navList.style[key] = "";
    }
    if (window.innerWidth <= breakpoint) {
      navList.style.display = "none";
    } else {
      navList.style.display = "flex";
    }
  }

  function setHamburgerState(isOpen) {
    bars.forEach((bar, index) => {
      bar.style.opacity = "1";
      bar.style.transform = "none";

      if (isOpen) {
        if (index === 0) {
          bar.style.transform =
            "translateY(" + (barGap + barHeight) + "px) rotate(45deg)";
        } else if (index === 1) {
          bar.style.opacity = "0";
          bar.style.transform = "scale(0)";
        } else if (index === 2) {
          bar.style.transform =
            "translateY(-" + (barGap + barHeight) + "px) rotate(-45deg)";
        }
      } else {
        if (index === 0) {
          bar.style.transform = "translateY(-" + barGap + "px)";
        } else if (index === 1) {
          bar.style.transform = "translateY(0)";
        } else if (index === 2) {
          bar.style.transform = "translateY(" + barGap + "px)";
        }
      }
    });
  }

  let isOpen = false;

  hamburger.addEventListener("click", function (e) {
    e.stopPropagation();
    if (window.innerWidth > breakpoint) return;

    isOpen = !isOpen;

    if (isOpen) {
      for (const [key, value] of Object.entries(activeMenuStyles)) {
        navList.style[key] = value;
      }
    } else {
      resetMenuStyles();
    }

    setHamburgerState(isOpen);
  });

  window.addEventListener("resize", handleResize);

  document.addEventListener("click", function (e) {
    if (
      isOpen &&
      !navList.contains(e.target) &&
      !hamburger.contains(e.target)
    ) {
      isOpen = false;
      resetMenuStyles();
      setHamburgerState(false);
    }
  });

  applyBaseStyles();
});
