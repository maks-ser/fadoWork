// <====================================================== Add Transitions
document.addEventListener('DOMContentLoaded', () => {
  setTimeout(() => {
    document.body.classList.add('show-body');
  }, 500);

  gsap.registerPlugin(ScrollTrigger);
})

// <====================================================== NATIVE SMOOTH SCROLLING
anchorSmoothScrolling();

function anchorSmoothScrolling() {
  let linkAnchors = document.querySelectorAll('[href^="#"]');

  for (let i = 0; i < linkAnchors.length; i++) {
    linkAnchors[i].addEventListener('click', function (e) {
      e.preventDefault();

      let scrollPage = window.pageYOffset,  // current scroll page
        hash = this.hash.replace('/^#/', '');
      if (!hash.length) return;
      let block = document.querySelector(hash);  // id block
      if (block === '' || block === null) return; // if not exist return
      let elTopScreen = block.getBoundingClientRect().top;  // position offset id

      //
      // ->
      if (linkAnchors[i].closest('.q-list')) {
        elTopScreen = qaAnchorTopChange(linkAnchors[i], block, elTopScreen);
      }
      // ->
      //

      animate({
        duration : 1500,
        timing(t) {
          return 1 + (
            --t
          ) * t * t * t * t;
        },
        draw(currentTime) {
          let progress = scrollPage + elTopScreen * currentTime;
          window.scrollTo(0, progress);
        }
      });
    });
  }
}

function animate({
  duration,
  timing,
  draw
}) {
  let start = performance.now();
  requestAnimationFrame(function animate(time) {
    let timeFraction = (
      time - start
    ) / duration;
    if (timeFraction > 1) timeFraction = 1;
    let progress = timing(timeFraction);
    draw(progress);
    if (timeFraction < 1) {
      requestAnimationFrame(animate);
    }
  });
}


// <====================================================== Q&A INFO CONTAINER
function qaAnchorTopChange(linkAnchor, block, elTopScreen) {
  const anchorTop = 143;
  const mobAnchorTop = 72;

  let qList = document.querySelector('.q-list');
  let qListItems = qList.querySelectorAll('.q-list__item');
  let qListItemsArray = Array.from(qListItems);

  let curItem = linkAnchor.closest('.q-list__item');
  let prevItem = qList.querySelector('.q-list__item.active');

  if (qListItemsArray.indexOf(prevItem) > qListItemsArray.indexOf(curItem)) {
    qList.classList.add('header-active');
    //
    if (window.innerWidth > 1023.5) {
      elTopScreen = block.getBoundingClientRect().top - anchorTop;
    }
    else {
      elTopScreen = block.getBoundingClientRect().top - mobAnchorTop;
    }
    //
  }
  else {
    qList.classList.remove('header-active');
  }
  //
  qList.querySelector('.active').classList.remove('active');
  curItem.classList.add('active');

  return elTopScreen;
}


// <====================================================== INLINE SVG
inlineSVG.init({
    svgSelector : '[inline-svg]', // the class attached to all images that should be inlined
    initClass   : 'js-inlinesvg', // class added to <html>
  }
  // , function () {
  //     console.log('All SVGs inlined');
  // }
);

{/* <img data-src="viber.svg" inline-svg alt=""></img> */
}


// <====================================================== FLYOUT ACTIVE
flyoutActive();

function flyoutActive() {
  const flyoutBtns = document.querySelectorAll('[data-flyout-button]');
  const flyoutTargets = document.querySelectorAll('[data-flyout-target]');

  if (!flyoutBtns.length) return;

  flyoutBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      let flyoutName = btn.dataset.flyoutButton;
      let target = document.querySelector(`[data-flyout-target="${flyoutName}"]`);

      flyoutTargets.forEach(target => {
        if (target.classList.contains('flyout-active')) {
          target.classList.remove('flyout-active');
        }
      })
      target.classList.add('flyout-active');
      //
      flyoutBtns.forEach(anotherBtn => {
        if (anotherBtn.classList.contains('active')) {
          anotherBtn.classList.remove('active');
        }
      })
      btn.classList.add('active');
      //
    })
  })

  // close flyout if the user clicked outside of it
  document.addEventListener('click', (e) => {
    if (!(
      e.target.closest('[data-flyout-button]') || e.target.closest('[data-flyout-target]')
    )) {
      if (document.querySelector('[data-flyout-target].flyout-active') && document.querySelector('[data-flyout-button].active')) {
        document.querySelector('[data-flyout-target].flyout-active').classList.remove('flyout-active');
        document.querySelector('[data-flyout-button].active').classList.remove('active');
      }
    }
  })
}


// <====================================================== BURGER MENU ACTIVE
burgerMenuActive();

function burgerMenuActive() {
  const menu = document.querySelector('.menu');
  const burger = document.querySelector('.burger');
  if (!burger || !menu) return;

  burger.addEventListener('click', () => {
    menu.classList.toggle('menu-active');

    if (!burger.classList.contains('open')) {
      burger.classList.remove('close');
      burger.classList.add('open');
    }
    else {
      burger.classList.remove('open');
      burger.classList.add('close');
    }

    // if( window.innerWidth < 1023.5 ) {
    //     document.body.classList.toggle('body-hidden');
    // }
  })

  // close flyout if the user clicked outside of it
  document.addEventListener('click', (e) => {
    if (!(
      e.target.closest('.burger') || e.target.closest('.menu')
    )) {
      if (document.querySelector('.burger.open') && document.querySelector('.menu.menu-active')) {
        document.querySelector('.menu.menu-active').classList.remove('menu-active');
        document.querySelector('.burger.open').classList.remove('open');
        document.querySelector('.burger').classList.add('close');
      }
    }
  })
}


// <====================================================== FLOATING HEADER
headerActive();

function headerActive() {
  const header = document.querySelector('.header');
  const headerHeight = 150; // 143
  const mobHeaderHeight = 72;
  let prevPos, curPos = 0;
  if (!header) return;

  let flyoutBtns = header.querySelectorAll('[data-flyout-button]');
  let flyoutTargets = header.querySelectorAll('[data-flyout-target]');
  let menu = header.querySelector('.menu');
  let burger = header.querySelector('.burger');
  //
  // for .q-list and .a-box in the .info-container
  let qList = document.querySelector('.q-list');
  //

  window.addEventListener('scroll', () => {
    prevPos = curPos;
    curPos = pageYOffset;

    if (pageYOffset > 0) {
      // if we scroll up
      if (curPos <= prevPos) {
        if (pageYOffset > 0) {
          // if ( pageYOffset > headerHeight ) {
          header.classList.remove('header-hide');
          //
          // put sticky q-list lower when fixed header is visible (when the page is being scrolled up)
          if (qList) {
            qList.classList.add('header-active');
          }
        }
      }
      // if we scroll down
      else {
        if (pageYOffset > headerHeight / 5) {
          // if ( pageYOffset > 0 ) {
          header.classList.add('header-hide');
          //
          flyoutBtns.forEach(btn => {
            if (btn.classList.contains('active')) {
              btn.classList.remove('active');
            }
          })
          flyoutTargets.forEach(flyout => {
            if (flyout.classList.contains('flyout-active')) {
              flyout.classList.remove('flyout-active');
            }
          })
          if (menu.classList.contains('menu-active')) {
            menu.classList.remove('menu-active');
          }
          if (burger.classList.contains('open')) {
            burger.classList.remove('open');
            burger.classList.add('close');
          }
          //
          // put sticky q-list at the default place when fixed header is hidden
          if (qList) {
            qList.classList.remove('header-active');
          }
          //
        }
      }
    }
    // when we scroll to the very top
    else {
      header.classList.remove('header-hide');
    }

  })
}


// <====================================================== REVEAL ON SCROLL
setTimeout(() => {
  return revealOnScroll('[data-reveal]');
}, 1000);

window.addEventListener('scroll', () => {
  return revealOnScroll('[data-reveal]');
});

function revealOnScroll(targetName) {
  let revealTargets = document.querySelectorAll(targetName);

  revealTargets.forEach(target => {
    let windowHeight = window.innerHeight;
    let revealTop = target.getBoundingClientRect().top;
    let revealPoint = -100; // -50; // 0; // 50;

    if (target.closest('[data-reveal-container]')) {
      let subtargets = target.closest('[data-reveal-container]').querySelectorAll('[data-reveal]');
      subtargets.forEach((subtarget, i) => {
        subtarget.style.transitionDelay = `${(
          i + 1
        ) * 0.05}s`;
      })
    }

    if (revealTop < windowHeight - revealPoint) {
      target.classList.add('reveal-active');
    }
    // else {
    //     target.classList.remove('reveal-active');
    // }

    // > activate reveal after preloader animation ends
    if (targetName === '[data-reveal-after-preloader]') {
      target.classList.add('reveal-active');
    }
  })
}


// <====================================================== LANG SELECT ACTIVE
langSelectActive();

function langSelectActive() {
  const selects = document.querySelectorAll('.lang-select');
  if (!selects.length) return;

  selects.forEach(select => {
    const selected = select.querySelector('.lang-select__selected');
    const optionsContainer = select.querySelector('.lang-select__options-container');
    const optionsWrapper = select.querySelector('.lang-select__options-wrapper');
    const optionsList = select.querySelectorAll('.lang-select__option');
    //
    let tempOption = null;
    if(selected) {
      selected.addEventListener('click', () => {
        if (optionsContainer.clientHeight) {
          optionsContainer.style.height = 0;
        }
        else {
          optionsContainer.style.height = optionsWrapper.clientHeight + 'px';
        }
        select.classList.toggle('active');
      });

      optionsList.forEach(option => {
        option.addEventListener('click', () => {
          //
          tempOption = selected.innerHTML;
          selected.innerHTML = option.querySelector('.lang-select__item').outerHTML;
          option.querySelector('.lang-select__item').outerHTML = tempOption;
          //
          optionsContainer.style.height = 0;
          select.classList.remove('active');
        })
      })

      // close select if clicked outside of it
      window.addEventListener('click', (e) => {
        if (e.target.closest('.lang-select')) return;

        optionsContainer.style.height = 0;
        select.classList.remove('active');
      })

    }
  })
}

// <====================================================== SELECT for page-map
const selectTraining = document.querySelector('.training-select');
const selectRegion = document.querySelector('.region-select');
const selectCity = document.querySelector('.city-select');
const selectAddress = document.querySelector('.address-select');

if (selectTraining) {
  selectActive(selectTraining);
}
if (selectRegion) {
  selectActive(selectRegion);
}
if (selectCity) {
  selectActive(selectCity);
}
if(selectAddress) {
  selectActive(selectAddress);
}

function selectActive(select) {
  const allSelects = document.querySelectorAll('.select');

  const selected = select.querySelector('.select__selected');
  const selectedValue = select.querySelector('.select__name'); // '.select__selected-value'
  const optionsContainer = select.querySelector('.select__options-container');
  const optionsWrapper = select.querySelector('.select__options-wrapper');
  const optionsList = select.querySelectorAll('.select__option');

  selected.addEventListener('click', () => {
    // check if this select was clicked before
    // in order to close all another selects when open the current one
    if (!selected.closest('.select').classList.contains('thisSelect')) {
      allSelects.forEach(anotherSelect => {
        if (anotherSelect.classList.contains('thisSelect')) {
          anotherSelect.classList.remove('thisSelect');

          anotherSelect.querySelector('.select__options-container').style.height = 0;
          //
          anotherSelect.classList.remove('select-active');
        }
      })
    }
    selected.closest('.select').classList.add('thisSelect');
    //

    if (optionsContainer.clientHeight) {
      optionsContainer.style.height = 0;
    }
    else {
      optionsContainer.style.height = optionsWrapper.clientHeight + 'px';
    }
    select.classList.toggle('select-active');
  });

  optionsList.forEach(option => {
    option.addEventListener('click', () => {
      // selected.innerHTML = option.querySelector('.select__name').innerHTML;
      // selectedValue.innerHTML = option.innerHTML;
      selected.innerHTML = option.innerHTML;
      optionsContainer.style.height = 0;
      //
      select.classList.remove('select-active');
    })
  })

  // close select if clicked outside of it
  window.addEventListener('click', (e) => {
    if (e.target.closest('.select')) return;

    optionsContainer.style.height = 0;
    //
    select.classList.remove('select-active');
  })
}


// <====================================================== SORTING [mobile tabs]
const sortingCategory = document.querySelector('.category-sorting');
const sortingTech = document.querySelector('.tech-sorting');

if (sortingCategory) {
  sortingActive(sortingCategory);
}
if (sortingTech) {
  sortingActive(sortingTech);
}

function sortingActive(sorting) {
  const allSortings = document.querySelectorAll('.sorting');

  const selected = sorting.querySelector('.sorting__selected');
  const selectedValue = sorting.querySelector('.sorting__name');
  const optionsContainer = sorting.querySelector('.sorting__options-container');
  const optionsWrapper = sorting.querySelector('.sorting__options-wrapper');
  const optionsList = sorting.querySelectorAll('.sorting__option');

  selected.addEventListener('click', () => {
    // check if this sorting was clicked before
    // in order to close all another selects when open the current one
    if (!selected.closest('.sorting').classList.contains('thisSorting')) {
      allSortings.forEach(anotherSorting => {
        if (anotherSorting.classList.contains('thisSorting')) {
          anotherSorting.classList.remove('thisSorting');

          anotherSorting.querySelector('.sorting__options-container').style.height = 0;
          anotherSorting.classList.remove('sorting-active');
        }
      })
    }
    selected.closest('.sorting').classList.add('thisSorting');
    //

    if (optionsContainer.clientHeight) {
      optionsContainer.style.height = 0;
    }
    else {
      optionsContainer.style.height = optionsWrapper.clientHeight + 'px';
    }
    sorting.classList.toggle('sorting-active');
  });

  optionsList.forEach(option => {
    option.addEventListener('click', () => {
      // selected.innerHTML = option.querySelector('.sorting__name').innerHTML;
      // selectedValue.innerHTML = option.innerHTML;
      selected.innerHTML = option.innerHTML;
      optionsContainer.style.height = 0;
      sorting.classList.remove('sorting-active');
    })
  })

  // close select if clicked outside of it
  window.addEventListener('click', (e) => {
    if (e.target.closest('.sorting')) return;

    optionsContainer.style.height = 0;
    sorting.classList.remove('sorting-active');
  })
}


// <====================================================== DROPDOWN
dropdownActive();

function dropdownActive() {
  const dropdowns = document.querySelectorAll('.dropdown');

  dropdowns.forEach(dropdown => {
    let showBtn = dropdown.querySelector('.dropdown__header');
    let content = dropdown.querySelector('.dropdown__content');
    let contentWrapper = dropdown.querySelector('.dropdown__wrapper');

    showBtn.addEventListener('click', () => {
      // check if this dropdown was clicked before
      // in order to close all another dropdowns when the current one is opened
      if (!dropdown.classList.contains('thisDropdown')) {
        dropdowns.forEach(anotherDropdown => {
          if (anotherDropdown.classList.contains('thisDropdown')) {
            anotherDropdown.classList.remove('thisDropdown');
            anotherDropdown.querySelector('.dropdown__content').style.height = 0;
            anotherDropdown.classList.remove('dropdown-active');
          }
        })
      }
      dropdown.classList.add('thisDropdown');
      //

      if (content.clientHeight) {
        content.style.height = 0;
        dropdown.classList.remove('dropdown-active');
      }
      else {
        content.style.height = contentWrapper.clientHeight + 'px';
        dropdown.classList.add('dropdown-active');
      }
    })
  })
}


// <====================================================== BACK BUTTON
backButtonActive();

function backButtonActive() {
  const backButtons = document.querySelectorAll('.back-btn');
  if (!backButtons.length) return;

  backButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      history.back(); // go to the previous page
    })
  })
}


// <====================================================== MAIN TITLE REVEAL ANIMATION [outdated]
mainTitleRevealAnimation();

function mainTitleRevealAnimation() {
  const titles = document.querySelectorAll('.main-title:not(.done)');
  if (!titles.length) return;

  titles.forEach((title, i) => {
    ScrollTrigger.create({
      trigger     : title,
      toggleClass : 'active',
      start       : 'top 100%',
      once        : true,
      // markers: 'true'
    })
  })
}


// <====================================================== NUMBER ITEM COUNT UP
document.addEventListener('DOMContentLoaded', () => {
  numberItemsActive();
});

window.addEventListener('scroll', () => {
  numberItemsActive();
})

function numberItemsActive() {
  const numberBox = document.querySelector('[data-number-box]');
  const numbers = document.querySelectorAll('[data-number-item]:not(.done)');
  if (!numbers.length || !numberBox) return;

  let windowHeight = window.innerHeight;
  if (numberBox.getBoundingClientRect().top < windowHeight) {
    numbers.forEach(num => {
      numberItemCountUp(num.dataset.numberItem, num);
    })
  }
}

function numberItemCountUp(value, item) {
  item.classList.add('done');

  let counter = 0;
  let timeStep = value / 3000;
  let valueStep = Math.ceil(timeStep * 25);

  setInterval(() => {
    if (counter >= value) {
      clearInterval();
    }
    else {
      counter += valueStep < 0 ? 1 : valueStep;
      //
      if (counter >= value) {
        counter = value;
      }
      //
      item.textContent = counter;
    }
  }, 25);
}


// <====================================================== TOGGLE STORAGE ON HOVER [numbers-container]
const numberImageBtns = document.querySelectorAll('[data-number-hover-button]');
const numberImageTargets = document.querySelectorAll('[data-number-hover-target]')

if (numberImageBtns.length || numberImageTargets.length) {
  toggleStorageOnHover(numberImageBtns, numberImageTargets);
}

function toggleStorageOnHover(btns, targets) {
  let buttonDatasetName = btns[0].attributes[1].name;
  let targetDatasetName = targets[0].attributes[1].name;

  btns.forEach(btn => {
    btn.addEventListener('mouseover', () => {
      let btnName = btn.getAttribute(buttonDatasetName);
      let activeTarget = document.querySelector(`[${targetDatasetName}="${btnName}"]`);

      targets.forEach(target => {
        if (target.classList.contains('active')) {
          target.classList.remove('active');
        }
      })
      activeTarget.classList.add('active');
      //
      btns.forEach(anotherBtn => {
        if (anotherBtn.classList.contains('active')) {
          anotherBtn.classList.remove('active');
        }
      })
      btn.classList.add('active');
      //
    })
  })
}


// <====================================================== TOGGLE STORAGE BLOCKS (with 'select all' option)
const catalogCategoryBtns = document.querySelectorAll('[data-catalog-category-button]');
const catalogCategoryTargets = document.querySelectorAll('[data-catalog-category-target]')

const portfolioCategoryBtns = document.querySelectorAll('[data-portfolio-category-button]');
const portfolioCategoryTargets = document.querySelectorAll('[data-portfolio-category-target]')

if (catalogCategoryBtns.length || catalogCategoryTargets.length) {
  toggleStorageAll(catalogCategoryBtns, catalogCategoryTargets);
}

if (portfolioCategoryBtns.length || portfolioCategoryTargets.length) {
  toggleStorageAll(portfolioCategoryBtns, portfolioCategoryTargets);
}

function toggleStorageAll(btns, targets) {
  let buttonDatasetName = btns[0].attributes[1].name;
  let targetDatasetName = targets[0].attributes[1].name;
  //
  const delayTime = 600;
  //
  // start
  let allBtn = document.querySelector(`[${buttonDatasetName}="all"]`)
  if (!allBtn) return;

  targets.forEach(target => {
    if (!target.classList.contains('show-block')) {
      target.classList.add('show-block');
    }
  })
  allBtn.classList.add('active');
  //
  // on tab click
  btns.forEach(btn => {
    btn.addEventListener('click', () => {
      let btnName = btn.getAttribute(buttonDatasetName);
      let activeTarget = null;

      if (btnName != 'all') {
        activeTarget = document.querySelector(`[${targetDatasetName}="${btnName}"]`);
        //
        // 1) add "hide" animation to active, then take down all classes
        targets.forEach(target => {
          if (target.classList.contains('show-block')) {
            target.classList.add('hide-block');
            setTimeout(() => {
              target.classList.remove('show-block');
              target.classList.remove('hide-block');
            }, delayTime);
          }
        })
        //
        // 2) then add "show" animation to new active
        setTimeout(() => {
          if(activeTarget)
          activeTarget.classList.add('show-block');
        }, delayTime);
        //
        // 3) then change buttons without animations
        btns.forEach(anotherBtn => {
          if (anotherBtn.classList.contains('active')) {
            anotherBtn.classList.remove('active');
          }
        })
        btn.classList.add('active');
        //
      }
      else {
        targets.forEach(target => {
          target.classList.add('hide-block');

          setTimeout(() => {
            target.classList.remove('hide-block');
            target.classList.add('show-block');
          }, delayTime);
        })
        //
        btns.forEach(anotherBtn => {
          if (anotherBtn.classList.contains('active')) {
            anotherBtn.classList.remove('active');
          }
        })
        btn.classList.add('active');
      }
    })
  })
}


// <====================================================== TOGGLE STORAGE BLOCKS {using switcher}
const productDetailBtns = document.querySelectorAll('[data-product-detail-button]');
const productDetailTargets = document.querySelectorAll('[data-product-detail-target]')

if (productDetailBtns.length || productDetailTargets.length) {
  toggleStorage(productDetailBtns, productDetailTargets);
}

function toggleStorage(btns, targets) {
  let buttonDatasetName = btns[0].attributes[1].name;
  let targetDatasetName = targets[0].attributes[1].name;
  const delayTime = 600;

  btns.forEach(btn => {
    btn.addEventListener('click', () => {
      let btnName = btn.getAttribute(buttonDatasetName);
      let activeTarget = document.querySelector(`[${targetDatasetName}="${btnName}"]`);

      // 1) add "hide" animation to active, then take down all classes
      targets.forEach(target => {
        if (target.classList.contains('show-block')) {
          target.classList.add('hide-block');
          setTimeout(() => {
            target.classList.remove('show-block');
            target.classList.remove('hide-block');
          }, delayTime);
        }
      })

      // 2) then add "show" animation to new active
      setTimeout(() => {
        if(activeTarget)
        activeTarget.classList.add('show-block');
      }, delayTime);

      // 3) then change buttons without animations
      btns.forEach(anotherBtn => {
        if (anotherBtn.classList.contains('active')) {
          anotherBtn.classList.remove('active');
        }
      })
      btn.classList.add('active');
    })
  })
}

// original toggleStorage w/o animation
// function toggleStorage(btns, targets) {
//     let buttonDatasetName = btns[0].attributes[1].name;
//     let targetDatasetName = targets[0].attributes[1].name;

//     btns.forEach( btn => {
//         btn.addEventListener('click', () => {
//             let btnName = btn.getAttribute(buttonDatasetName);
//             let activeTarget = document.querySelector(`[${targetDatasetName}="${btnName}"]`);

//             targets.forEach( target => {
//                 if( target.classList.contains('show-block') ) {
//                     target.classList.remove('show-block');
//                 }
//             })
//             activeTarget.classList.add('show-block');

//             btns.forEach( anotherBtn => {
//                 if( anotherBtn.classList.contains('active') ) {
//                     anotherBtn.classList.remove('active');
//                 }
//             })
//             btn.classList.add('active');
//         })
//     })
// }


// <====================================================== TAB SWITCHER [projects.html]
if (window.innerWidth > 767.5) {
  tabSlide();
}
window.addEventListener('resize', () => {
  if (window.innerWidth > 767.5) {
    tabSlide();
  }
})

function tabSlide() {
  const switcher = document.querySelector('.switcher');
  if (!switcher) return;

  const tabs = switcher.querySelectorAll('.switcher__tab');
  const line = switcher.querySelector('.switcher__line');

  for (let i = 0; i < tabs.length; i++) {
    tabs[i].addEventListener('click', () => {
      line.style.left = `calc(calc(100% / ${tabs.length}) * ${i})`;
    });
  }
}


// <====================================================== PAGINATION
paginationActive();

function paginationActive() {
  const paginationBlocks = document.querySelectorAll('.pagination');
  if (!paginationBlocks.length) return;

  paginationBlocks.forEach(pagBlock => {
    let pagNums = pagBlock.querySelectorAll('.pagination__item');
    pagNums.forEach(num => {
      num.addEventListener('click', () => {
        pagBlock.querySelector('.active').classList.remove('active');
        num.classList.add('active');
      })
    })
  })
}


// <====================================================== Q&A INFO CONTAINER
// qaAnchorScroll();

// function qaAnchorScroll() {
//     const anchors = document.querySelectorAll('.anchor');
//     const qList = document.querySelector('.q-list');
//     if( ! qList ) return;

//     const qListItems = qList.querySelectorAll('.q-list__item');
//     qListItems.forEach( (item, index) => {
//         item.addEventListener('click', () => {
//             //
//             let prevItem = qList.querySelector('.q-list__item.active');
//             let qListItemsArray = Array.from(qListItems);

//             if( qListItemsArray.indexOf(prevItem) > index) {
//                 qList.classList.add('header-active');
//                 //
//                 anchors.forEach( anchor => {
//                     anchor.classList.add('header-active');
//                 })
//                 //
//             }
//             else {
//                 qList.classList.remove('header-active');
//                 //
//                 anchors.forEach( anchor => {
//                     anchor.classList.remove('header-active');
//                 })
//                 //
//             }
//             //
//             qList.querySelector('.active').classList.remove('active');
//             item.classList.add('active');
//         })
//     })
// }


// <====================================================== IMAGE LAZY LOADING
// <================================================ CUSTOM IMAGE LAZYLOADING


document.addEventListener('DOMContentLoaded', function () {
  imgLazyLoading();
});

window.addEventListener('scroll', () => {
  imgLazyLoading();
})

function imgLazyLoading() {
  let images = document.querySelectorAll('.lazy-img:not(.loaded)');

  if (images) {
    let windowHeight = window.innerHeight * 2;

    images.forEach((img, i) => {
      let source = img.previousElementSibling;

      if (img.getBoundingClientRect().top < windowHeight) {
        if (img.hasAttribute('data-src')) {
          img.src = img.getAttribute('data-src');
        }
        if (source && source.hasAttribute('data-srcset')) {
          source.srcset = source.getAttribute('data-srcset');
        }

        img.classList.add('loaded');
      }
    });
  }
}


// <====================================================== MAP PIN [contact.html]
/*mapInfoActive();

function mapInfoActive() {
  let mapPins = document.querySelectorAll('.map-pin');
  let mapInfos = document.querySelectorAll('.map-info');

  mapPins.forEach(pin => {
    let pinIcon = pin.querySelector('.map-pin__icon');
    let mapInfo = pin.querySelector('.map-info');
    let cross = pin.querySelector('.map-info__cross');

    pinIcon.addEventListener('click', () => {
      mapInfos.forEach(info => {
        if (info.classList.contains('active')) {
          info.classList.remove('active');
        }
      })
      mapInfo.classList.add('active');
    })

    cross.addEventListener('click', () => {
      mapInfo.classList.remove('active');
    })

    // close map-info if the user clicked outside of it
    document.addEventListener('click', (e) => {
      if (!e.target.closest('.map-pin')) {
        mapInfo.classList.remove('active');
      }
    })
  })

}*/

// <====================================================== HERO SLIDER
let heroColorSlider = new Swiper('.hero-color-slider', {
  autoplay: {
    delay: 5000,
  },
  direction     : 'horizontal',
  slidesPerView : 1,
  spaceBetween  : 0,

  // simulateTouch: true,
  // touchRatio: 1,
  allowTouchMove : false,
  speed          : 1000,

  slideActiveClass : 'hero-active',
})

let heroSlider = new Swiper('.hero-slider', {
  autoplay: {
    delay: 5000,
  },
  direction     : 'horizontal',
  slidesPerView : 1,
  spaceBetween  : 0,

  // simulateTouch: true,
  // touchRatio: 1,
  // allowTouchMove: false,
  speed : 500,

  slideActiveClass : 'hero-active',

  effect     : 'fade',
  fadeEffect : {
    crossFade   : true,
    transformEl : '.hero-slide',
  },

  // mousewheel : {
  //   eventsTarget  : '.hero',
  //   // releaseOnEdges: true,
  //   sensitivity   : 1, // 1000,
  //   thresholdTime : 1500, // 500,
  // },

  breakpoints : {
    320  : {
      // direction      : 'vertical',
      allowTouchMove : true,
      simulateTouch  : true,
      touchRatio     : 1,
    },
    1024 : {
      direction      : 'horizontal',
      allowTouchMove : false,
      simulateTouch  : false,
      touchRatio     : 0,
    },
    1200 : {
      direction      : 'horizontal',
      allowTouchMove : false,
      simulateTouch  : false,
      touchRatio     : 0,
    }
  },

  on : {
    slideChange : function () {
      // hero sliders sync
      heroColorSlider.slideToLoop(heroSlider.realIndex);
      heroTitleSlider.slideToLoop(heroSlider.realIndex);
      // heroDescriptionSlider.slideToLoop(heroSlider.realIndex);
      // heroButtonSlider.slideToLoop(heroSlider.realIndex);
      //
      // set transition-delay to current slide to make a smooooth opacity transition
      let prevSlide = this.slides[this.previousIndex].children[0];
      let currentSlide = this.slides[this.activeIndex].children[0];
      currentSlide.style.transitionDuration = '1000ms';
      currentSlide.style.transitionDelay = '500ms';
      setTimeout(() => {
        currentSlide.style.transitionDelay = '0ms';
      }, 500);
      //
      // data-hero-buttons active
      let heroBtns = document.querySelectorAll('[data-hero-button]');
      heroBtns.forEach(anotherBtn => {
        if (anotherBtn.classList.contains('active')) {
          anotherBtn.classList.remove('active');
        }
      })
      let heroBtn = document.querySelector(`[data-hero-button="${heroSlider.realIndex}"]`);
      // if move forward
      if (this.previousIndex < this.activeIndex) {
        heroBtns.forEach(btn => {
          btn.style.transition = 'color 0.25s cubic-bezier(0.23, 1, 0.32, 1) 0.1s';
        })
      }
      // if move backward
      else {
        heroBtns.forEach(btn => {
          btn.style.transition = 'color 0.25s cubic-bezier(0.23, 1, 0.32, 1) 0.5s';
        })
      }
      heroBtn.classList.add('active');
      //
      // .hero__list color change
      let heroList = document.querySelector('.hero__list');
      if (this.activeIndex === 0) {
        heroList.classList.remove('black');
        heroList.classList.remove('gray');
      }
      else if (this.activeIndex === 1) {
        heroList.classList.add('black');
        heroList.classList.remove('gray');
      }
      else if (this.activeIndex === 2) {
        heroList.classList.remove('black');
        heroList.classList.add('gray');
      }
      //
      // release on edge
      if (this.activeIndex === this.slides.length - 1) {
        setTimeout(() => {
          heroSlider.params.mousewheel.releaseOnEdges = true;
        }, 1000);

        //
        // console.log('i am the last slide');
        //mx
        // if (window.innerWidth < 1023.5) {
        //   setTimeout(() => {
        //     heroSlider.disable();
        //   }, 1000);
        // }
      }
      else {
        //mx
        // heroSlider.params.mousewheel.releaseOnEdges = false;
        //
        // //
        // if (window.innerWidth < 1023.5) {
        //   heroSlider.enable();
        // }
      }
      //mx
      // window.addEventListener('scroll', () => {
      //   // console.log('scroll');
      //
      //   if (scrollY === 0) {
      //     // console.log('scrollY === 0');
      //     heroSlider.params.mousewheel.releaseOnEdges = false;
      //     heroSlider.enable();
      //   }
      //   else {
      //     // heroSlider.disable();
      //
      //     if (window.innerWidth > 1023.5) {
      //       heroSlider.disable();
      //     }
      //   }
      // })
      //
    },
  },
})
let heroTitleSlider = new Swiper('.hero-title-slider', {
  direction     : 'vertical',
  slidesPerView : 1,
  spaceBetween  : 150,

  // simulateTouch: true,
  // touchRatio: 1,
  allowTouchMove : false,
  speed          : 1000,

  slideActiveClass : 'hero-active',

  breakpoints : {
    320  : {
      spaceBetween : 16,
    },
    768  : {
      spaceBetween : 64,
    },
    1024 : {
      spaceBetween : 150,
    }
  }
})

//
// function addListenerMulti(el, s, fn) {
//     s.split(' ').forEach(e => el.addEventListener(e, fn, false));
// }
//

// hero slider workflow
if (heroSlider.el.classList != undefined) {
  heroSliderWorkflow(heroSlider);
}

function heroSliderWorkflow(slider) {
  let heroBtns = document.querySelectorAll('[data-hero-button]');

  heroBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      // remove 'active' class from the previously active item
      heroBtns.forEach(anotherBtn => {
        if (anotherBtn.classList.contains('active')) {
          anotherBtn.classList.remove('active');
        }
      })
      // add 'active' class to the currently active item and slide the slider to the active slide
      slider.slideTo(btn.dataset.heroButton);
      btn.classList.add('active');
    })
  })
  //
}

//
//


// <======================================================  SWIPER SLIDER INIT
// product slider
let subProductSlider = new Swiper('.sub-product-slider', {
  direction     : 'horizontal',
  slidesPerView : 3,
  spaceBetween  : 16,

  simulateTouch : true,
  touchRatio    : 1,
  speed         : 1000,
  loop          : true,
})
let productSlider = new Swiper('.product-slider', {
  direction     : 'horizontal',
  slidesPerView : 1,
  spaceBetween  : 0,

  simulateTouch : true,
  touchRatio    : 1,
  speed         : 1000,
  loop          : true,

  thumbs : {
    swiper                : subProductSlider,
    slideThumbActiveClass : 'thumb-active',
  },

  navigation : {
    nextEl : '.product-slider-arrow-next',
    prevEl : '.product-slider-arrow-prev',
  }
})

// about slider
let aboutYearSlider = new Swiper('.about-year-slider', {
  direction     : 'vertical',
  spaceBetween  : 0, // 20,
  slidesPerView : 3, // 3.4, // 1, // 3,
  speed         : 800,

  slideActiveClass : 'slide-active',
  centeredSlides   : true,
  // centeredSlidesBounds: true,

  on : {
    slideChange : function () {
      aboutInfoSlider.slideToLoop(aboutYearSlider.realIndex);
      // console.log('111111111');
    },
  },

  breakpoints : {
    320  : {
      spaceBetween  : 0,
      slidesPerView : 3,
    },
    1024 : {
      spaceBetween  : 0,
      slidesPerView : 3,
    }
  }
})
let aboutInfoSlider = new Swiper('.about-info-slider', {
  direction     : 'vertical',
  spaceBetween  : 0, // 20,
  slidesPerView : 3, // 3.4, // 1, // 3,
  speed         : 800,

  mousewheel : {
    eventsTarget   : '.slider-container',   // fixes slider-container while it's being scrolled
    // releaseOnEdges: true,                // and releases it on the first/last slides
    // sensitivity: 1000,
    releaseOnEdges : false,
    sensitivity    : 1, // 1000,
    thresholdTime  : 1000, // 500,
  },

  // mousewheel: false,//////////

  slideActiveClass : 'slide-active',
  centeredSlides   : true,
  // centeredSlidesBounds: true,

  on : {
    slideChange : function () {
      aboutYearSlider.slideToLoop(aboutInfoSlider.realIndex);

      //
      // release on edge
      // if( this.activeIndex === 0 || this.activeIndex == this.slides.length - 1 ) {
      //     setTimeout( () => {
      //         sliderContainer.classList.remove('fixed');
      //         document.body.classList.remove('body-hidden');
      //         aboutInfoSlider.params.mousewheel.releaseOnEdges = true;
      //     }, 1000);

      //     console.log('i am the first/last slide');
      // }
      // else {
      //     aboutInfoSlider.params.mousewheel.releaseOnEdges = false;
      // }
      // //
      // let sliderContainer = document.querySelector('.slider-container');
      // window.addEventListener('scroll', () => {
      //     console.log('scrollY: ' + scrollY);

      //     // if( scrollY >= sliderContainer.getBoundingClientRect().top ||  scrollY <= sliderContainer.getBoundingClientRect().bottom ) {
      //     if( sliderContainer.getBoundingClientRect().top <= 0 ||  sliderContainer.getBoundingClientRect().bottom <= window.innerHeight ) {
      //         console.log('scrollY is out of scope');
      //         aboutInfoSlider.params.mousewheel.releaseOnEdges = false;
      //         aboutInfoSlider.enable();
      //     }
      //     else {
      //         aboutInfoSlider.disable();
      //     }
      // })

      // // release on edge
      // if( this.activeIndex === this.slides.length - 1) {
      //     setTimeout( () => {
      //         heroSlider.params.mousewheel.releaseOnEdges = true;
      //     }, 1000);

      //     console.log('i am the last slide');
      // }
      // else {
      //     heroSlider.params.mousewheel.releaseOnEdges = false;
      // }
      // //
      // window.addEventListener('scroll', () => {
      //     if(scrollY === 0) {
      //         console.log('scrollY === 0');
      //         heroSlider.params.mousewheel.releaseOnEdges = false;
      //         heroSlider.enable();
      //     }
      //     else {
      //         heroSlider.disable();
      //     }
      // })
    },
  },

  breakpoints : {
    320 : {
      spaceBetween  : 0,
      slidesPerView : 1.3,
    },
    768 : {
      spaceBetween  : 0,
      slidesPerView : 3,
    }
  }
})
//
sliderFix();

function sliderFix() {
  let sliderContainer = document.querySelector('.slider-container');
  if (!sliderContainer) return;

  let sliderTop = sliderContainer.getBoundingClientRect().top; // + 50;
  let sliderBottom = sliderContainer.getBoundingClientRect().bottom - window.innerHeight - 25;

  let flow = sliderContainer.querySelector('.slider-container__flow');
  let defaultHeight = flow.getBoundingClientRect().height;
  let prevPos = 0, curPos = 0;

  window.addEventListener('scroll', () => {
    prevPos = curPos;
    curPos = scrollY;

    // if slider-container is in the viewport
    if (sliderContainer.getBoundingClientRect().top <= 0 && sliderContainer.getBoundingClientRect().bottom >= window.innerHeight) {
      aboutInfoSlider.enable();

      // if we scroll down
      if (curPos > prevPos) {
        aboutInfoSlider.on('slideChange', () => {
          // if we are at first slide
          if (aboutInfoSlider.activeIndex === 0) {
            aboutInfoSlider.params.mousewheel.releaseOnEdges = false;
            aboutInfoSlider.enable();
          }
          // else if we are at last slide
          else if (aboutInfoSlider.activeIndex == aboutInfoSlider.slides.length - 1) {
            setTimeout(() => {
              aboutInfoSlider.params.mousewheel.releaseOnEdges = true;
              aboutInfoSlider.disable();

              window.scrollTo(0, sliderBottom);
            }, 1000);
          }
        })
      }
      // if we scroll up
      else {
        aboutInfoSlider.on('slideChange', () => {
          // if we are at first slide
          if (aboutInfoSlider.activeIndex === 0) {
            setTimeout(() => {
              aboutInfoSlider.params.mousewheel.releaseOnEdges = true;
              aboutInfoSlider.disable();

              window.scrollTo(0, sliderTop);
            }, 1000);
          }
          // else if we are at last slide
          else if (aboutInfoSlider.activeIndex == aboutInfoSlider.slides.length - 1) {
            aboutInfoSlider.params.mousewheel.releaseOnEdges = false;
            aboutInfoSlider.enable();
            // stopBtn.parentElement.classList.remove('fixed')
          }
        })
      }
    }
    else {
      aboutInfoSlider.disable();

    }
  })
}


videoWorkflow();

// poster frame click event
function videoWorkflow() {
  const videoPlayBtns = document.querySelectorAll('[data-video-play-button]');

  videoPlayBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      let wrapper = e.target.closest('.video');
      videoPlay(wrapper);
    })
  })
}

// play the targeted video (and hide the poster frame)
function videoPlay(wrapper) {
  let iframe = wrapper.querySelector('.video__video');
  let caption = wrapper.querySelector('.video__caption');
  let src = iframe.dataset.videoSrc;
  // hide poster
  caption.classList.add('hide-video-caption');
  // add iframe src in, starting the video
  iframe.setAttribute('src', src);
}


// <====================================================== MODAL VIDEOS [reviews.html]
modalVideoActive();

function modalVideoActive() {
  let modalBtns = document.querySelectorAll('[data-modal-button="video"]');
  let modal = document.querySelector('[data-modal-target="video"]');

  modalBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      let video = btn.closest('[data-modal-button="video"]').querySelector('[data-video-source]');
      let videoSrc = video.innerHTML;
      let modalSrc = modal.querySelector('[data-modal-video]');
      modalSrc.innerHTML = videoSrc;

      videoWorkflow();
    })
  })

}

function stopPopupVideo(videoWrapper) {
  let video = videoWrapper.querySelector('.video__video');
  video.src = ''; // videoSrc;
}


// <====================================================== PROJECT INFO IN POPUP UPDATE
projectPopupUpdate();

function projectPopupUpdate() {
  let popupBtns = document.querySelectorAll('[data-popup-button="project"]');
  let popup = document.querySelector('[data-popup-target="project"]');

  popupBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      let project = btn.closest('[data-popup-button="project"]').querySelector('.project');
      let projectSrc = project.outerHTML; // project.innerHTML;
      let popupSrc = popup.querySelector('.project');
      popupSrc.outerHTML = projectSrc;
    })
  })
}

// <====================================================== MODAL
const openPopupBtns = document.querySelectorAll('[data-popup-button]');
const closePopupBtns = document.querySelectorAll('[data-popup-close]');
const body = document.querySelector('body');
const bodyWrapper = document.querySelector('.body-wrapper');
const lockPaddingTargets = document.querySelectorAll('.lock-padding');
let unlock = true;
const timeout = 1000; // must be equal to the transition-duration of .popup

//
const openModalBtns = document.querySelectorAll('[data-modal-button]');
const closeModalBtns = document.querySelectorAll('[data-modal-close]');

modalActive();

function modalActive() {
  if (openModalBtns.length > 0) {
    openModalBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const modalName = btn.dataset.modalButton;
        const modalTarget = document.querySelector(`[data-modal-target=${modalName}]`);

        modalOpen(modalTarget);
      })
    })
  }

  if (closeModalBtns.length > 0) {
    closeModalBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        modalClose(btn.closest('.modal'));
      })
    })
  }
}

function modalOpen(modal) {
  if (modal && unlock) {
    // close all active modals if they exist
    const modalActive = document.querySelector('.modal.modal-active');
    if (modalActive) {
      modalClose(modalActive, false);
    }
    else {
      bodyLock();
    }
    //
    modal.classList.add('modal-active');

    // close popup if the user clicked outside of it
    modal.addEventListener('click', (e) => {
      if (!e.target.closest('.modal__content')) {
        modalClose(e.target.closest('.modal'));
      }
    })
  }
}

function modalClose(modal, doUnlock = true) {
  if (unlock) {
    modal.classList.remove('modal-active');
    if (doUnlock) {
      bodyUnlock();
    }
    // --stop all videos when close popup
    if (modal.querySelector('[data-modal-video]')) {
      stopPopupVideo(modal.querySelector('[data-modal-video]'));
    }
    //
  }
}

function bodyLock() {
  let lockPaddingValue = 0;
  if (!bodyWrapper) {
    lockPaddingValue = window.innerWidth - document.body.offsetWidth + 'px';
  }
  else {
    lockPaddingValue = window.innerWidth - document.querySelector('.body-wrapper').offsetWidth + 'px';
  }

  if (lockPaddingTargets.length > 0) {
    lockPaddingTargets.forEach(target => {
      target.style.paddingRight = lockPaddingValue;
    })
  }
  body.style.paddingRight = lockPaddingValue;
  body.classList.add('body-hidden');

  unlock = false;
  setTimeout(() => {
    unlock = true;
  }, timeout);

}

function bodyUnlock() {
  setTimeout(() => {
    if (lockPaddingTargets.length > 0) {
      lockPaddingTargets.forEach(target => {
        target.style.paddingRight = '0px';
      })
    }
    body.style.paddingRight = '0px';
    body.classList.remove('body-hidden');
  }, timeout);

  unlock = false;
  setTimeout(() => {
    unlock = true;
  }, timeout);
}

// <====================================================== POPUP
popupActive();

function popupActive() {
  if (openPopupBtns.length > 0) {
    openPopupBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const popupName = btn.dataset.popupButton;
        const popupTarget = document.querySelector(`[data-popup-target=${popupName}]`);

        popupOpen(popupTarget);
      })
    })
  }

  if (closePopupBtns.length > 0) {
    closePopupBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        popupClose(btn.closest('.popup'));
      })
    })
  }
}

function popupOpen(popup) {
  if (popup && unlock) {
    // close all active popups if they exist
    const popupActive = document.querySelector('.popup.popup-active');
    if (popupActive) {
      popupClose(popupActive, false);
    }
    else {
      bodyLock();
    }
    //
    popup.classList.add('popup-active');

    // close popup if the user clicked outside of it
    popup.addEventListener('click', (e) => {
      if (!e.target.closest('.popup__content')) {
        popupClose(e.target.closest('.popup'));
      }
    })
  }
}

function popupClose(popup, doUnlock = true) {
  if (unlock) {
    popup.classList.remove('popup-active');
    if (doUnlock) {
      bodyUnlock();
    }
  }
}


// <====================================================== FORM
// <====================================================== TELEPHONE MASK
const telInputs = document.querySelectorAll('input[type="tel"]');
let inputMask = new Inputmask('+38 (999) 999-99-99');
inputMask.mask(telInputs);


// <====================================================== FORM VALIDATION AND SENDING
document.addEventListener('DOMContentLoaded', () => {
  let formBl = $('form').not('.b-search');
  let ppAlert = document.querySelector('[data-popup-target="thanks"]');
  if (formBl.length) {
    formBl.submit(formSend);
    let sendUrl = '/wp-content/themes/theme-sp/mail/mail.php';

    async function formSend(e) {
      e.preventDefault();
      let _this = this;

      let error = formValidate(_this);
      let formData = new FormData(_this);
      formData.append('location_url', window.location.href);

      if (error === 0) {
        _this.classList.add('_sending');
        let response = await fetch(sendUrl, {
          method : 'POST',
          body   : formData
        });

        if (response.ok) {
          let result = await response.json();

          if (result.send) {
            let ppActive = document.querySelector('.popup-active');
            if (ppActive) {
              popupClose(ppActive);
              setTimeout(function () {
                popupOpen(ppAlert);
              }, 1000);
            }
            else {
              popupOpen(ppAlert);
            }
            _this.reset();
            let fileBtn = $(_this).find('.file-active');
            if (fileBtn.length) {
              fileBtn.removeClass('file-active');
              let fileTxt = fileBtn.find('[data-def]');
              fileTxt.text(fileTxt.data('def'));
            }
            let selectTitle = $(_this).find('[data-option-choose]');
            if (selectTitle.length) {
              let selectTxt = selectTitle.data('option-choose');
              selectTitle.find('span').text(selectTxt);
            }
          }
          else {
            alert(result.error);
          }

        }
        else {
          alert(messageErrorSend);
          _this.classList.remove('_sending');
        }

        _this.classList.remove('_sending');
      }
      else {
        //alert(messageRequire);
      }
    }

    function formValidate(form) {
      let error = 0;
      let formReq = form.querySelectorAll('._required');

      for (let i = 0; i < formReq.length; i++) {
        const input = formReq[i];
        formRemoveError(input);

        if (input.classList.contains('_email')) {
          if (input.value === '') {
            formAddError(input, 'empty');
            error++;
          }
          else if (!emailCheck(input)) {
            formAddError(input, 'incorrect');
            error++;
          }
        }
        else if (input.classList.contains('_tel')) {
          if (input.value === '') {
            formAddError(input, 'empty');
            error++;
          }
          else if (!telCheck(input)) {
            formAddError(input, 'incorrect');
            error++;
          }
        }
        else if (input.classList.contains('_checkbox')) {
          if (!input.checked) {
            // console.log('NOT CHECKED');

            formAddError(input, 'notChecked');
            error++;
          }
        }
        else if (input.classList.contains('_file')) {
          let filename = input.value; // input.dataset.filename;
          // console.log('filename: ' + filename);

          if (filename === '') {
            formAddError(input, 'emptyFile');
            error++;
          }
          else if (!fileCheck(filename)) {
            formAddError(input, 'incorrectFile');
            error++;
          }
        }
        else {
          if (input.value === '') {
            formAddError(input, 'empty');
            error++;
          }
        }
      }

      return error;
    }

    function formAddError(input, errorType) {
      // checkbox error add
      if (errorType === 'notChecked') {
        input.closest('.checkbox').classList.add('_error');
        return;
      }
      //

      let formInput = input.closest('.form-input');
      let errorMessage = formInput.querySelector('.failure__text');

      if (errorType === 'emptyFile') {
        errorMessage.innerHTML = messageEmpty;
        input.previousElementSibling.classList.add('_error');
      }
      if (errorType === 'incorrectFile') {
        errorMessage.innerHTML = messageIncorrectFile;
        input.previousElementSibling.classList.add('_error');
      }
      if (errorType === 'incorrect') {
        errorMessage.innerHTML = messageIncorrect;
      }
      if (errorType === 'empty') {
        errorMessage.innerHTML = messageEmpty;
      }

      input.closest('.form-input').querySelector('.failure').classList.add('_error');   // _error для "заповніть поле" / "некоректні дані"
      formInput.classList.add('_error');                                                // _error для инпута
    }

    function formRemoveError(input) {
      // checkbox error remove
      if (input.classList.contains('_checkbox')) {
        input.closest('.checkbox').classList.remove('_error');
        return;
      }
      //
      // common input field error remove
      input.closest('.form-input').querySelector('.failure').classList.remove('_error');
      input.closest('.form-input').classList.remove('_error');
      //
      // file field error remove
      if (input.previousElementSibling !== null && input.previousElementSibling.classList.contains('_error')) {
        input.previousElementSibling.classList.remove('_error');
      }
    }

    // регулярное выражение для проверки корректности email
    function emailCheck(input) {
      return /^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i.test(input.value);
    }

    // регулярное выражение для проверки корректности telephone
    function telCheck(input) {
      return /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){11,13}(\s*)?$/.test(input.value);
    }

    // проверки корректности файла
    function fileCheck(input) {
      let fileType = input.substr(input.lastIndexOf('.') + 1);    // get the type of the file

      return (
        fileType === 'pdf' || fileType === 'doc' || fileType === 'docx' || fileType === input
      ) ? true : false;
    }
  }
})


// <====================================================== FILE UPLOAD
fileUploadActive();

function fileUploadActive() {
  const defaultBtns = document.querySelectorAll('.file-field__default-btn');

  defaultBtns.forEach(defaultBtn => {
    let fileInput = defaultBtn.previousElementSibling;  // ('.file-field')
    let wrapper = fileInput.querySelector('.file-field__wrapper');
    let fileName = wrapper.querySelector('.file-field__file-name');
    // let uploadBtn = wrapper.querySelector('.file-field__button_upload');
    let deleteBtn = wrapper.querySelector('.file-field__button_delete');
    let regExp = /[а-я0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

    wrapper.addEventListener('click', () => {
      defaultBtn.click();
    })

    defaultBtn.addEventListener("change", function () {
      const file = this.files[0];

      if (this.value) {
        let valueStore = this.value.match(regExp);
        fileName.textContent = valueStore;

        fileInput.classList.add('file-active');
      }

      deleteBtn.addEventListener('click', (e) => {
        e.stopPropagation();    // prevents "defaultBtn.click();" event by click on wrapper

        this.value = '';
        fileName.textContent = messageChooseFile;
        fileInput.classList.remove('file-active');

        if (defaultBtn.nextElementSibling !== null && defaultBtn.nextElementSibling.classList.contains('_error')) {
          defaultBtn.nextElementSibling.classList.remove('_error');
        }
        // file field error remove
        if (fileInput.classList.contains('_error')) {
          fileInput.classList.remove('_error');
          fileInput.closest('.form-input').classList.remove('_error');
        }
      })
    });
  })

}

document.addEventListener('DOMContentLoaded', function () {
  $(".tabs-box__item").click(function () {
    setTimeout(function () {
      let scrollEvent = new UIEvent('scroll');
      window.dispatchEvent(scrollEvent);
    },1000);
  });
});

//mx js
const mxSearch = document.querySelector('.mx__seach-btn')
const mxSearchCloseBtn = document.getElementById('m-search-close')
const stopBtn = document.querySelector('.page-template-page-brend-fado .stop__btn-item')
const searchBlock = document.querySelector('.menu__search')
mxSearch.addEventListener("click", function(e) {
  e.preventDefault()

  if(searchBlock.classList.contains('show')) {
    searchBlock.classList.remove('show')
  }else {
    searchBlock.classList.add('show')
  }
})
if(mxSearchCloseBtn) {
    mxSearchCloseBtn.addEventListener("click" , function(event) {
        // console.log(event.target)
        event.preventDefault()
        searchBlock.classList.remove('show')
    })
}
if(stopBtn) {
  stopBtn.addEventListener('click', function(e) {
    e.preventDefault()
    aboutInfoSlider.destroy(true, true)
    aboutYearSlider.destroy(true, true)
    const mxCont = document.querySelector('.mx-relative')
    mxCont.style.maxHeight = 90 + 'vh'
    mxCont.style.overflow = 'hidden'
  })
}


