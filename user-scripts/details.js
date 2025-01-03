const orderBtn = document.querySelectorAll('.order-btn');
const backBtn = document.querySelectorAll('.order-opt-btn .back');
const modal = document.querySelector('.modal');

orderBtn.forEach(btn => {
  btn.addEventListener('click', () => {
    modal.showModal();
  });
});

backBtn.forEach(btn => {
  btn.addEventListener('click', () => {
    modal.close();
  });
});