const sectionBtns = document.querySelectorAll('.options > div > div');
const optBtns = document.querySelectorAll('.buttons > div');
const foodOptBtns = document.querySelectorAll('.food-buttons > div');
const dessertOptBtns = document.querySelectorAll('.desserts-buttons > div');
const tableOptBtns = document.querySelectorAll('.tables-buttons > div');
const foodDrink = document.querySelector('.food-drink');
const desserts = document.querySelector('.desserts');
const navBtn = document.querySelectorAll('.nav-btn');
const home = document.querySelector('.home');
const food = document.querySelector('.food');
const dessertsNav = document.querySelector('.desserts-nav');
const tablesReservation = document.querySelector('.tables-reservation');
const feedback = document.querySelector('.feedback');
const contactUs = document.querySelector('.contact-us');
const mFood = document.getElementById('myanmar-food');
const tFood = document.getElementById('thai-food');
const kFood = document.getElementById('korean-food');
const cake = document.getElementById('dessert-cake');
const ic = document.getElementById('dessert-ic');
const pizza = document.getElementById('dessert-pizza');
const coffee = document.getElementById('dessert-coffee');
const ordinary = document.querySelector('.ordinary');
const family = document.querySelector('.family');

function switchActive(parentBtn, button, classList){
  button.addEventListener('click', () => {
    if(button.classList.contains(classList)) return;

    parentBtn.forEach(btn => {
      btn.classList.remove(classList);
    });
    button.classList.add(classList);
  });
}

function chooseSection(btn, sName){
  const clicked = btn.textContent.trim().toLowerCase();
  Object.keys(sName).forEach(section => {
    sName[section].style.display = section === clicked ? 'grid' : 'none';
  });
}
  
  sectionBtns.forEach(btns => switchActive(sectionBtns, btns, 'active'));
  optBtns.forEach(btns => switchActive(optBtns, btns, 'opt-btn-active'));
  foodOptBtns.forEach(btns => switchActive(foodOptBtns, btns, 'opt-btn-active'));
  foodOptBtns.forEach(btns => switchActive(foodOptBtns, btns, 'opt-btn-active'));
  dessertOptBtns.forEach(btns => switchActive(dessertOptBtns, btns, 'opt-btn-active'));
  tableOptBtns.forEach(btns => switchActive(tableOptBtns, btns, 'opt-btn-active'));
  
  const homeSection = {
    'food & drinks': foodDrink,
    'desserts': desserts
  }
  
  optBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      chooseSection(btn, homeSection);
    });
  });
  
  const sections = {
    home,
    food,
    desserts: dessertsNav,
    'tables reservation': tablesReservation,
    feedback
  }
  navBtn.forEach(btn => {
    btn.addEventListener('click', () => {
      chooseSection(btn, sections);
    });
  });
  
  const foodSection = {
    'thai food': tFood,
    'myanmar food': mFood,
    'korean food': kFood
  }
  
  foodOptBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      chooseSection(btn, foodSection);
    });
  });
  
  const dessertSection = {
    cake,
    'ice cream': ic,
    pizza,
    coffee
  }
  
  dessertOptBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      chooseSection(btn, dessertSection);
    });
  });
  
  const tableSection = {ordinary, family}
  
  tableOptBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      chooseSection(btn, tableSection);
    });
  });  