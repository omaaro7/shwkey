import { info, initializeData } from '../modules/getData.js';

(async () => {
  let categoryArr =[]
  let categoriesNum = 0
  // Initialize the data
  await initializeData();
  let boxes = document.querySelectorAll(".box-content .con");
  boxes[0].textContent = info[0].users.length
  boxes[1].textContent = info[0].category.length
  boxes[2].textContent = info[0].game.length

})();
