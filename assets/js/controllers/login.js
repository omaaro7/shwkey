let form = document.querySelector(".form");
let formInput = document.querySelectorAll("input");
form.addEventListener("submit", async (e) => {
  e.preventDefault();
  let data = {
    parent_phonenumber: formInput[0].value.trim(),
    password: formInput[1].value.trim(),
  };
  let res = await fetch(`../../handlers/login.php`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  });
  let info = await res.json();
  if (info.status == "success") {
    window.localStorage.setItem("token", JSON.stringify(info.user.token));
    Swal.fire({
      icon: "success",
      title: "تم تسجيل الدخول بنجاح",
    }).then(() => {
      window.location.href = "../main/home.php";
    });
  }
});
