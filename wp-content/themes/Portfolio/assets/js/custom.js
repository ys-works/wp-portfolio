// logo hover animation
document.addEventListener("DOMContentLoaded", () => {
  const logo = document.querySelector(".header-wrap .logo a");

  if (!logo) return;

  logo.addEventListener("mouseenter", () => {
    const url =
      "/wp-content/themes/Portfolio/assets/images/header/cat3_h1.apng?t=" +
      Date.now();

    logo.style.setProperty("--apng-url", `url(${url})`);
    logo.classList.add("is-active");
  });

  logo.addEventListener("mouseleave", () => {
    logo.classList.remove("is-active");
  });
});

// hero 再生/一時停止ボタン
document.addEventListener("DOMContentLoaded", () => {
  const video = document.querySelector(".hero video");
  const btn = document.querySelector(".video-toggle img");

  const playIcon = "/wp-content/themes/Portfolio/assets/images/icon/play.svg";
  const pauseIcon = "/wp-content/themes/Portfolio/assets/images/icon/pause.svg";

  if (!video || !btn) return;

  btn.src = pauseIcon;

  btn.parentElement.addEventListener("click", () => {
    if (video.paused) {
      video.play();
      btn.src = pauseIcon;
    } else {
      video.pause();
      btn.src = playIcon;
    }
  });
});

// スクロールでセクションがフェードイン
document.addEventListener("DOMContentLoaded", () => {
  // ========== 1. フェードイン（IntersectionObserver） ==========
  const fadeEls = document.querySelectorAll(".js-fade-up, .js-fade-up-first");

  fadeEls.forEach((el, index) => {
    const isFirst = el.classList.contains("js-fade-up-first");
    const delay = isFirst ? 0 : index * 0.2;
    const duration = isFirst ? "0.3s" : "0.8s";

    el.style.opacity = "0";
    el.style.transform = "translateY(40px)";
    el.style.transition = `opacity ${duration} ease, transform ${duration} ease`;
    el.style.transitionDelay = `${delay}s`;
  });

  const fadeObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = "1";
          entry.target.style.transform = "translateY(0)";
          fadeObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.1, rootMargin: "0px 0px -50px 0px" },
  );

  fadeEls.forEach((el) => fadeObserver.observe(el));

  // ========== 2. スケールアップ＆背景拡張（スクロール連動） ==========
  // 共通の進捗計算関数
  const calculateProgress = (rect) => {
    const windowH = window.innerHeight;
    return Math.min(Math.max((windowH - rect.top) / (windowH * 0.7), 0), 1);
  };

  // ----- スケールアップ -----
  const scaleEls = document.querySelectorAll(".js-scale-up");

  scaleEls.forEach((el) => {
    el.style.transform = "scale(0.2)";
    el.style.transformOrigin = "center center";
    el.style.transition = "transform 0.1s linear";
  });

  const updateScale = () => {
    scaleEls.forEach((el) => {
      if (el.dataset.done === "true") return;

      const progress = calculateProgress(el.getBoundingClientRect());
      el.style.transform = `scale(${progress * 0.8 + 0.2})`;

      if (progress >= 0.99) {
        el.dataset.done = "true";
        el.style.transform = "scale(1)";
      }
    });
  };

  // ----- 背景拡張 -----
  const expandEls = document.querySelectorAll(".js-expand-bg");

  expandEls.forEach((el) => {
    if (el.dataset.initialized === "true") return;

    const bg = document.createElement("div");
    bg.className = "js-expand-bg-inner";
    bg.style.cssText = `
      position: absolute;
      inset: 0;
      background: rgb(33, 33, 33);
      transform: scaleX(0);
      transform-origin: center center;
      z-index: 0;
      pointer-events: none;
      transition: transform 0.1s linear;
    `;

    el.style.position = "relative";
    el.style.overflow = "hidden";
    el.prepend(bg);

    Array.from(el.children).forEach((child) => {
      if (!child.classList.contains("js-expand-bg-inner")) {
        child.style.position = "relative";
        child.style.zIndex = "1";
      }
    });

    el.dataset.initialized = "true";
  });

  const updateExpand = () => {
    expandEls.forEach((el) => {
      if (el.dataset.done === "true") return;

      const bg = el.querySelector(".js-expand-bg-inner");
      if (!bg) return;

      const progress = calculateProgress(el.getBoundingClientRect());
      bg.style.transform = `scaleX(${progress})`;

      if (progress >= 0.99) {
        el.dataset.done = "true";
        bg.style.transform = "scaleX(1)";
      }
    });
  };

  // スクロール時
  window.addEventListener(
    "scroll",
    () => {
      requestAnimationFrame(() => {
        updateScale();
        updateExpand();
      });
    },
    { passive: true },
  );

  // DOMContentLoaded直後と、画像読み込み完了後の両方で実行
  requestAnimationFrame(() => {
    updateScale();
    updateExpand();
  });

  window.addEventListener("load", () => {
    updateScale();
    updateExpand();
  });
});

// サイドバー用ドロワーメニュー
function updatePrefix(btn) {
  const expanded = btn.getAttribute('aria-expanded') === 'true';
  btn.firstChild.textContent = expanded ? '- ' : '+ ';
}

document.querySelectorAll('.sidebar-toggle__list').forEach(list => {
  list.style.overflow = 'hidden';
  const btn = document.querySelector(`[aria-controls="${list.id}"]`);
  const expanded = btn.getAttribute('aria-expanded') === 'true';
  list.style.height = expanded ? list.scrollHeight + 'px' : '0px';
  btn.insertBefore(document.createTextNode(expanded ? '- ' : '+ '), btn.firstChild);
});

function closeToggle(btn) {
  const list = document.getElementById(btn.getAttribute('aria-controls'));
  btn.setAttribute('aria-expanded', 'false');
  updatePrefix(btn);
  list.animate(
    [{ height: list.scrollHeight + 'px' }, { height: '0px' }],
    { duration: 300, easing: 'ease', fill: 'forwards' }
  ).finished.then(() => {
    list.style.height = '0px';
  });
}

function openToggle(btn) {
  const list = document.getElementById(btn.getAttribute('aria-controls'));
  btn.setAttribute('aria-expanded', 'true');
  updatePrefix(btn);
  list.animate(
    [{ height: '0px' }, { height: list.scrollHeight + 'px' }],
    { duration: 300, easing: 'ease', fill: 'forwards' }
  ).finished.then(() => {
    list.style.height = list.scrollHeight + 'px';
  });
}

document.querySelectorAll('.sidebar-toggle__btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const expanded = btn.getAttribute('aria-expanded') === 'true';

    document.querySelectorAll('.sidebar-toggle__btn').forEach(other => {
      if (other === btn) return;
      closeToggle(other);
    });

    expanded ? closeToggle(btn) : openToggle(btn);
  });
});