const i = document.querySelector('.nav i');
const s_cat = document.querySelector('.switch-btn .categories');
const s_add = document.querySelector('.switch-btn .add-new');
const c_list = document.querySelector('.category-list');
const s_list = document.querySelector('.session-list');

let did = false;

i.addEventListener('click', () => {
  if(!did){
    s_add.style.display = 'none';
    s_cat.style.display = 'block';
    s_list.style.display = 'none';
    c_list.style.display = 'flex';
    did = true;
  } else{
    s_add.style.display = 'block';
    s_cat.style.display = 'none';
    s_list.style.display = 'flex';
    c_list.style.display = 'none';
    did = false;
  }
});