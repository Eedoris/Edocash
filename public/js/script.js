const phoneBtn = document.getElementById('phoneBtn');
const phoneAction = document.getElementById('phoneAction');

phoneBtn.addEventListener('click', () => {
  phoneAction.classList.add('phone-active');
});

const menu = document.getElementById('menu');
const openMenu = document.getElementById('openMenu');
const closeMenu = document.getElementById('closeMenu');

openMenu.addEventListener('click', () => {
  menu.style.display = 'flex';
});

closeMenu.addEventListener('click', () => {
  menu.style.display = 'none';
});

/* */
document.addEventListener("DOMContentLoaded", () => {
  const words = window.heroJobs || [];

  const el = document.getElementById("dynamic-job");

  if (!el || words.length === 0) return;

  let wordIndex = 0;
  let charIndex = 0;
  let isDeleting = false;

  function typeEffect() {
    const currentWord = words[wordIndex];

    if (!isDeleting) {
      el.textContent = currentWord.substring(0, charIndex + 1);
      charIndex++;

      if (charIndex === currentWord.length) {
        setTimeout(() => isDeleting = true, 1200);
      }
    } else {
      el.textContent = currentWord.substring(0, charIndex - 1);
      charIndex--;

      if (charIndex === 0) {
        isDeleting = false;
        wordIndex = (wordIndex + 1) % words.length;
      }
    }

    setTimeout(typeEffect, isDeleting ? 60 : 120);
  }

  typeEffect();
});

// Script pour scroll auto contenu institutionnel
const items = document.querySelectorAll('.motif_listitem');
const progressFill = document.querySelector('.motif_scrollfill');
let currentIndex = -1;
let intervalId;
const slideDuration = 5000;
const minWidthForAutoSlide = 1130;

function showItem(index) {

  items.forEach(item => item.classList.remove('active'));

  currentIndex = index;

  // Activer l'élément sélectionné
  items[currentIndex].classList.add('active');

  // Calculer et mettre à jour la progression
  const progress = ((currentIndex + 1) / items.length) * 100;
  progressFill.style.transition = 'height 0.5s linear';
  progressFill.style.height = `${progress}%`;

}

function showNextItem() {
  const nextIndex = (currentIndex + 1) % items.length;
  showItem(nextIndex);
}

function resetAutoSlide() {
  // Effacer l'intervalle existant
  if (intervalId) {
    clearInterval(intervalId);
  }

  // Réinitialiser la transition pour l'animation automatique
  progressFill.style.transition = 'height 5s linear';

}

function handleResize() {
  if (window.innerWidth >= minWidthForAutoSlide) {
    if (!intervalId) {
      resetAutoSlide();
    }
  } else {
    if (intervalId) {
      clearInterval(intervalId);
      intervalId = null;
    }
  }
}

// Ajouter les écouteurs d'événements pour chaque item
items.forEach(item => {
  item.addEventListener('click', function () {
    const index = parseInt(this.getAttribute('data-index'));
    showItem(index);
  });
});

window.addEventListener('resize', handleResize);

showItem(0);

document.addEventListener('DOMContentLoaded', function () {
  const slider = document.getElementById('motivationsSlider');
  const nextBtn = document.querySelector('.slider-btn.next');
  const prevBtn = document.querySelector('.slider-btn.prev');

  if (slider && nextBtn && prevBtn) {
    const card = document.querySelector('.motivation-card');
    if (card) {
      const cardWidth = card.offsetWidth;
      const gap = 20; // Même valeur que dans le CSS
      const scrollAmount = cardWidth + gap;

      // Gérer la navigation
      nextBtn.addEventListener('click', () => {
        slider.scrollBy({
          left: scrollAmount,
          behavior: 'smooth'
        });
      });

      prevBtn.addEventListener('click', () => {
        slider.scrollBy({
          left: -scrollAmount,
          behavior: 'smooth'
        });
      });

      // Désactiver les boutons aux extrémités
      function checkScroll() {
        const isAtStart = slider.scrollLeft <= 10;
        const isAtEnd = slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10;

        prevBtn.style.opacity = isAtStart ? '0.5' : '1';
        prevBtn.style.cursor = isAtStart ? 'default' : 'pointer';
        prevBtn.disabled = isAtStart;

        nextBtn.style.opacity = isAtEnd ? '0.5' : '1';
        nextBtn.style.cursor = isAtEnd ? 'default' : 'pointer';
        nextBtn.disabled = isAtEnd;
      }

      // Vérifier au chargement et au scroll
      slider.addEventListener('scroll', checkScroll);
      checkScroll();
    }
  }
});



document.addEventListener('DOMContentLoaded', function () {
  const mediaButtons = document.querySelectorAll('.media-logo-btn');
  const articles = document.querySelectorAll('.press-article');
  const progressBar = document.querySelector('.progress-bar');
  let currentIndex = 0;
  let autoSlideInterval;
  const slideDuration = 6000;


  function goToSlide(index) {

    mediaButtons.forEach(btn => btn.classList.remove('active'));
    mediaButtons[index].classList.add('active');


    articles.forEach(article => article.classList.remove('active'));
    articles[index].classList.add('active');

    currentIndex = index;


    restartProgressBar();
  }

  function restartProgressBar() {
    progressBar.style.animation = 'none';
    void progressBar.offsetWidth;
    progressBar.style.animation = `progress ${slideDuration}ms linear`;
  }


  mediaButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
      clearInterval(autoSlideInterval);
      goToSlide(index);
      startAutoSlide();
    });
  });


  function nextSlide() {
    let nextIndex = (currentIndex + 1) % mediaButtons.length;
    goToSlide(nextIndex);
  }

  function startAutoSlide() {
    clearInterval(autoSlideInterval);
    autoSlideInterval = setInterval(nextSlide, slideDuration);
  }

  function handleVisibilityChange() {
    if (document.hidden) {
      clearInterval(autoSlideInterval);
      progressBar.style.animationPlayState = 'paused';
    } else {
      startAutoSlide();
      progressBar.style.animationPlayState = 'running';
    }
  }

  goToSlide(0);
  startAutoSlide();


  document.addEventListener('visibilitychange', handleVisibilityChange);


  const sliderContainer = document.querySelector('.press-articles-slider');
  sliderContainer.addEventListener('mouseenter', () => {
    clearInterval(autoSlideInterval);
    progressBar.style.animationPlayState = 'paused';
  });

  sliderContainer.addEventListener('mouseleave', () => {
    startAutoSlide();
    progressBar.style.animationPlayState = 'running';
  });
});
/*document.addEventListener('DOMContentLoaded', function () {
  const filterTabs = document.querySelectorAll('.filter-tab');
  const searchInput = document.querySelector('.search-input');
  const articles = document.querySelectorAll('.pressroom-releases__item');

  // Filtrage par catégorie
  filterTabs.forEach(tab => {
    tab.addEventListener('click', function () {
      // Mettre à jour les onglets actifs
      filterTabs.forEach(t => t.classList.remove('active'));
      this.classList.add('active');

      const filter = this.dataset.filter;
      filterArticles(filter, searchInput.value.toLowerCase());
    });
  });

  // Recherche en temps réel
  searchInput.addEventListener('input', function () {
    const searchTerm = this.value.toLowerCase();
    const activeFilter = document.querySelector('.filter-tab.active').dataset.filter;
    filterArticles(activeFilter, searchTerm);
  });

  function filterArticles(filter, searchTerm) {
    let visibleCount = 0;

    articles.forEach(article => {
      const category = article.dataset.category;
      const title = article.querySelector('.pressroom-releases__title').textContent.toLowerCase();
      const text = article.querySelector('.pressroom-releases__text').textContent.toLowerCase();

      // Vérifier le filtre de catégorie
      const categoryMatch = filter === 'all' || category === filter;

      // Vérifier la recherche
      const searchMatch = !searchTerm ||
        title.includes(searchTerm) ||
        text.includes(searchTerm);

      if (categoryMatch && searchMatch) {
        article.style.display = 'block';
        setTimeout(() => {
          article.style.opacity = '1';
          article.style.transform = 'translateY(0)';
        }, 10);
        visibleCount++;
      } else {
        article.style.opacity = '0';
        article.style.transform = 'translateY(20px)';
        setTimeout(() => {
          article.style.display = 'none';
        }, 300);
      }
    });

    // Mettre à jour le compteur
    const countElement = document.querySelector('.press-grid__count');
    if (countElement) {
      countElement.textContent = `${visibleCount} article${visibleCount > 1 ? 's' : ''}`;
    }
  }

  // Initialiser le compteur
  const countElement = document.querySelector('.press-grid__count');
  if (countElement) {
    countElement.textContent = `${articles.length} articles`;
  }
});*/

document.addEventListener('DOMContentLoaded', function () {

  const faqItems = document.querySelectorAll('.faq-item');
  const searchInput = document.getElementById('faqSearch');
  const searchResults = document.getElementById('searchResults');
  const categoryButtons = document.querySelectorAll('.category-btn');
  const expandAllBtn = document.getElementById('expandAll');

  let allExpanded = false;


  faqItems.forEach(item => {
    const questionBtn = item.querySelector('.faq-question');
    const answer = item.querySelector('.faq-answer');

    questionBtn.addEventListener('click', () => {
      const isExpanded = questionBtn.getAttribute('aria-expanded') === 'true';


      if (!isExpanded) {
        faqItems.forEach(otherItem => {
          if (otherItem !== item) {
            otherItem.classList.remove('active');
            otherItem.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
          }
        });
      }


      item.classList.toggle('active');
      questionBtn.setAttribute('aria-expanded', !isExpanded);


      const icon = questionBtn.querySelector('.faq-icon svg');
      icon.style.transition = 'transform 0.3s ease';


      if (!isExpanded) {
        const index = item.dataset.index;
        console.log('FAQ viewed:', index);


        questionBtn.style.backgroundColor = '#f8f9ff';
        setTimeout(() => {
          questionBtn.style.backgroundColor = '';
        }, 300);
      }
    });
  });

  searchInput.addEventListener('input', function () {
    const searchTerm = this.value.toLowerCase().trim();
    searchResults.innerHTML = '';

    if (searchTerm.length < 2) {
      searchResults.style.display = 'none';
      return;
    }

    const matchingItems = [];

    faqItems.forEach(item => {
      const question = item.querySelector('.question-text').textContent.toLowerCase();
      const answer = item.querySelector('.answer-content').textContent.toLowerCase();

      if (question.includes(searchTerm) || answer.includes(searchTerm)) {
        matchingItems.push(item);
      }
    });

    if (matchingItems.length > 0) {
      searchResults.style.display = 'block';

      matchingItems.forEach(item => {
        const questionText = item.querySelector('.question-text').textContent;
        const resultItem = document.createElement('div');
        resultItem.className = 'search-result-item';
        resultItem.textContent = questionText;

        resultItem.addEventListener('click', () => {
          // Close all items
          faqItems.forEach(faqItem => {
            faqItem.classList.remove('active');
            faqItem.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
          });


          item.classList.add('active');
          item.querySelector('.faq-question').setAttribute('aria-expanded', 'true');


          item.scrollIntoView({ behavior: 'smooth', block: 'center' });

          searchInput.value = '';
          searchResults.style.display = 'none';

          item.style.animation = 'none';
          setTimeout(() => {
            item.style.animation = 'highlight 1.5s ease';
          }, 10);
        });

        searchResults.appendChild(resultItem);
      });
    } else {
      searchResults.style.display = 'block';
      const noResults = document.createElement('div');
      noResults.className = 'search-result-item';
      noResults.textContent = 'Aucun résultat trouvé';
      noResults.style.color = '#999';
      noResults.style.fontStyle = 'italic';
      searchResults.appendChild(noResults);
    }
  });


  categoryButtons.forEach(btn => {
    btn.addEventListener('click', () => {

      categoryButtons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const category = btn.dataset.category;


      faqItems.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
          item.style.display = 'block';
          setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
          }, 10);
        } else {
          item.style.opacity = '0';
          item.style.transform = 'translateY(10px)';
          setTimeout(() => {
            item.style.display = 'none';
          }, 300);
        }
      });
    });
  });


  expandAllBtn.addEventListener('click', () => {
    allExpanded = !allExpanded;

    faqItems.forEach(item => {
      const questionBtn = item.querySelector('.faq-question');

      if (allExpanded) {
        item.classList.add('active');
        questionBtn.setAttribute('aria-expanded', 'true');
      } else {
        item.classList.remove('active');
        questionBtn.setAttribute('aria-expanded', 'false');
      }
    });

    expandAllBtn.innerHTML = allExpanded
      ? `<svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <path d="M6 10H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
               </svg>
               Tout réduire`
      : `<svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <path d="M10 6V14M6 10H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
               </svg>
               Tout développer`;
  });


  document.addEventListener('click', (e) => {
    if (!e.target.closest('.faq-search')) {
      searchResults.style.display = 'none';
    }
  });


  const style = document.createElement('style');
  style.textContent = `
        @keyframes highlight {
            0% { background-color: transparent; }
            10% { background-color: rgba(107, 78, 255, 0.1); }
            100% { background-color: transparent; }
        }
        
        .faq-item {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
    `;
  document.head.appendChild(style);

});

