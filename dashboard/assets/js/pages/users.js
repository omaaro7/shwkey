//!imports
import { info, initializeData } from "../modules/getData.js";
import getCookieValue from "../modules/getCookies.js";
//helprs
let reloadCount = 0;
await initializeData();
//*show filter (click for show filter)
(async () => {
  let filterClicker = document.querySelector(".filtred-title");
  let filterBox = document.querySelector(".filtred-box");
  filterClicker.addEventListener("click", (e) => {
    filterBox.classList.toggle("d-none");
  });
})();
//*apply filters
(async () => {
  let filterMethods = {
    latest: () => Array.from(info[0].users).reverse(),
    oldest: () => Array.from(info[0].users),
    alphabet: () => {
      return Array.from(info[0].users).sort((a, b) => {
        return a.name.localeCompare(b.name, "ar", { sensitivity: "base" });
      });
    },
    alphabetEn: () => {
      return Array.from(info[0].users).sort((a, b) => {
        const isEnglishA = /^[a-zA-Z]/.test(a.name);
        const isEnglishB = /^[a-zA-Z]/.test(b.name);

        // English names first
        if (isEnglishA && !isEnglishB) return -1;
        if (!isEnglishA && isEnglishB) return 1;

        // If both are the same type (English or Arabic), sort normally
        return a.name.localeCompare(b.name, "ar", { sensitivity: "base" });
      });
    },
  };

  let listBox = document.querySelector(".users-list-box");
  let filterItems = document.querySelectorAll(".filter-item");

  filterItems.forEach((item, index) => {
    item.addEventListener("click", async (e) => {
      let selectedMethod = "";
      console.log(e.target);

      if (filterItems[index].dataset.type == 0) {
        selectedMethod = filterMethods.latest();
      } else if (filterItems[index].dataset.type == 1) {
        selectedMethod = filterMethods.oldest();
      } else if (filterItems[index].dataset.type == 2) {
        selectedMethod = filterMethods.alphabet();
      } else if (filterItems[index].dataset.type == 3) {
        selectedMethod = filterMethods.alphabetEn();
      }
      console.log(selectedMethod);

      listBox.innerHTML = "";
      selectedMethod.forEach((user) => {
        listBox.innerHTML += `
          <div class="user-list-item col-12 d-flex align-items-center justify-content-between px-2 py-3">
            <div class="name text-center col-2">${user.name}</div>
            <div class="parent-name text-center col-2">${user.parent_name}</div>
            <div class="parent-type text-center col-2">${user.parent_type}</div>
            <div class="parent-phone text-center col-3">${user.parent_phonenumber}</div>
            <div class="age text-center col-1">${user.date_birth}</div>
            <div class="parent-age text-center col-1">${user.parent_data_birth}</div>
            <div class="settings text-center col-1"><i class="fa-light fa-pen-to-square" data-id="${user.id}"></i></div>
          </div>
        `;
      });
      await showSettings();
    });
  });
})();
//*search on user
(async () => {
  let tableHeader = document.querySelector(".users-list-header")
  let searchInput = document.querySelector("form.search input");
  let searchResultBox = document.querySelector(
    "form.search .serch-results-box"
  );
  searchInput.addEventListener("input", async (e) => {
    let res = await fetch(
      `../handlers/search.php?&q=${e.target.value}`
    );
    let data = await res.json();
    console.log(data);

    let titles = {
      name: "الإسم",
      parent_name: " ولي الأمر",
      parent_type: "صفة ولي الأمر",
      parent_phonenumber: "رقم ولي الأمر",
      parent_data_birth: "تاريخ ميلاد ولي الأمر",
      date_birth: "تاريخ الميلاد",
      coins: "النقات",
    };
    let result = [];
     await data.data.users.forEach((ele, index) => {
      ele.matched_columns.forEach((column) => {
        Object.keys(titles).forEach((key) => {
          if (column == key) {
            result.push({
              title: [titles[`${key}`],key],
              main_title: column,
              id: ele.id,
              row_data: ele[`${key}`],
            });
          }
        });
      });
    });
    console.log(result);
    
    //!set results in box
    console.log(result);
    
    searchResultBox.innerHTML = "";
    if (result.length != 0) {
      searchResultBox.classList.remove("d-none");
      result.reverse().forEach((ele, index) => {
        let item = `<div class="res-item col-12 p-2 d-flex align-items-center mt-2" data-id="${ele.id}" data-key="${ele.title[1]}">
                <div class="res-item-title"> ${ele.title[0]} : </div>
                <div class="res-item-value">${ele.row_data} </div>
  
              </div>`;
        searchResultBox.innerHTML += item;
      });
      //!apl click on result
      let res = document.querySelectorAll(".res-item");
      let usersBox = document.querySelector(".users-list-box");

      res.forEach((ele, index) => {
        ele.addEventListener("click", async (e) => {
          usersBox.innerHTML = "";
          searchResultBox.classList.add("d-none");
          result.forEach((one) => {
            info[0].users.forEach((user) => {
              if (
                user.id == one.id &&
                user[`${one.main_title}`] == one.row_data
                
              ) {                
                for (const tit of tableHeader.children) {                  
                    if (tit.id == one.title[1]) {
                      tit.style.cssText = `
                        color:white;
                        background:rgb(47 136 220);
                        padding:10px 0;
                        border-radius:40px;
                      `
                    }
                }
                usersBox.innerHTML += `
                  <div class="user-list-item col-12 d-flex align-items-center justify-content-between px-2 py-3">
                      <div class="name text-center col-2">${user.name}</div>
                      <div class="parent-name text-center col-2">${user.parent_name}</div>
                      <div class="parent-type text-center col-2">${user.parent_type}</div>
                      <div class="parent-phone text-center col-3">${user.parent_phonenumber}</div>
                      <div class="age text-center col-1">${user.date_birth}</div>
                      <div class="parent-age text-center col-1">${user.parent_data_birth}</div>
                      <div class="settings text-center col-1"><i class="fa-light fa-pen-to-square" data-id="${user.id}"></i></div>
                  </div>`;
              }
            });
          });
          await showSettings();
        });
      });
    } else {
      searchResultBox.classList.add("d-none");
    }
  });
})();
//*show users in list
(async () => {
  let listBox = document.querySelector(".users-list-box");
  Array.from(info[0].users)
    .reverse()
    .forEach((user) => {
      listBox.innerHTML += `
     <div class="user-list-item col-12 d-flex align-items-center justify-content-between px-2 py-3">
     <div class="name text-center col-2">${user.name}</div>
     <div class="parent-name text-center col-2">${user.parent_name}</div>
     <div class="parent-type text-center col-2">${user.parent_type}</div>
     <div class="parent-phone text-center col-3">${user.parent_phonenumber}</div>
     <div class="age text-center col-1">${user.date_birth}</div>
     <div class="parent-age text-center col-1">${user.parent_data_birth}</div>
     <div class="settings text-center col-1"><i class="fa-light fa-pen-to-square" data-id="${user.id}"></i></div>
 </div>
 
 `;
    });
})();
//*show settings function
async function showSettings() {
  let settings = document.querySelectorAll(".settings i");
  let box = document.querySelector(".user-settings-container");
  let inputs = document.querySelectorAll("form.settings-form input");
  settings.forEach((button, index) => {
    button.addEventListener("click", async (e) => {
      inputs[0].parentElement.parentElement.setAttribute(
        "data-id",
        e.target.dataset.id
      );
      box.classList.remove("d-none");
      info[0].users.forEach((user) => {
        if (user.id == button.dataset.id) {
          inputs[0].value = user.name;
          inputs[1].value = user.parent_name;
          inputs[2].value = user.parent_type;
          inputs[3].value = user.parent_phonenumber;
          inputs[4].value = user.date_birth;
          inputs[5].value = user.parent_data_birth;
          inputs[6].value = user.edited;
        }
      });
    });
  });
}
//*send new data (edit user)
(async () => {
  let inputs = document.querySelectorAll("form.settings-form input");
  let saveButton = document.querySelector(".save-changes");
  saveButton.addEventListener("click", async (e) => {
    e.preventDefault();
    let data = {
      name: inputs[0].value,
      parent_name: inputs[1].value,
      parent_type: inputs[2].value,
      parent_phonenumber: inputs[3].value,
      date_birth: inputs[4].value,
      parent_data_birth: inputs[5].value,
      edited: inputs[6].value + 1 + reloadCount,
    };
    Swal.fire({
      title: "هل انت متأكد من حفظ هذه التغيرات ؟ ",
      html: `
          <h4>الاسم : ${data.name}</h4>
          <br/>
          <h4>اسم ولي الأمر : ${data.parent_name}</h4>
          <br/>
          <h4>صفة ولي الأمر : ${data.parent_type}</h4>
          <br/>
          <h4>رقم ولي الأمر : ${data.parent_phonenumber}</h4>
          <br/>
          <h4>العمر : ${data.date_birth}</h4>
          <br/>
          <h4>عمر ولي الأمر : ${data.parent_data_birth}</h4>
          <br/>
        `,
      showCancelButton: true,
      confirmButtonText: "نعم",
      cancelButtonText: "لا",
      icon: "warning",
    }).then(async (result) => {
      if (result.isConfirmed) {
        let res = await fetch(
          `../handlers/putData.php?id=${parseInt(
            inputs[0].parentElement.parentElement.dataset.id
          )}&table=users&admin_token=${getCookieValue("admin_token")}`,
          {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
          }
        );
        if (res.ok) {
          Swal.fire({
            title: "تم حفظ التغيرات بنجاح",
            icon: "success",
          }).then(() => {
            reloadCount++;
          });
        }
      }
    });
  });
})();
//*close settings
(async () => {
  await showSettings();
  let closer = document.querySelector(".close-settings");
  let box = document.querySelector(".user-settings-container");
  closer.addEventListener("click", (e) => {
    box.classList.add("d-none");
  });
})();
