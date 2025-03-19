let publisher;
//open and close text box typing
(() => {
  let typingBoxOpener = document.querySelector(".typing");
  let typingBox = document.querySelector(".typing-box-container");
  openBoxes(typingBoxOpener, typingBox);
  typingBoxOpener.addEventListener("click", () => {
    publisher = document.querySelector(".publish");
    createPost();
  });
  close(document.querySelector(".typing-box .closer i"), typingBox);
})();
//open and close emojy box
(() => {
  let emojyBoxOpenr = document.querySelector(".button-3");
  let emojyBox = document.querySelector(".feelings-box-container");
  openBoxes(emojyBoxOpenr, emojyBox);
  emojyBoxOpenr.addEventListener("click", () => {
    publisher = document.querySelector(".publish-feeling");
    createPost()
  });
  close(document.querySelector(".feelings-box .closer i"), emojyBox);
})();
//upload post
function createPost() {
  let postType = 1;
  let visibility = 1;
  let choises = document.querySelectorAll(".choise");
  choises.forEach((ele) => {
    ele.addEventListener("click", (e) => {
      visibility = +e.target.dataset.visibility;
    });
  });

  let feel = null;
  let emojies = document.querySelectorAll(".emoji i ");
  emojies.forEach((ele) => {
    ele.addEventListener("click", (e) => {
      emojies.forEach(
        (el) => (el.parentElement.style.background = "transparent")
      );
      e.target.parentElement.style.cssText =
        "background:#6eacda; border-radius: 20px; padding:10px 5px;";
      feel = +e.target.parentElement.dataset.feel;
    });
  });
  async function createPostWithImage(
    postText,
    imageFile,
    visibility,
    post_type,
    rea
  ) {
    const userToken = document.cookie
      .split("; ")
      .find((row) => row.startsWith("token="))
      ?.split("=")[1];
    console.log(userToken);

    if (!userToken) {
      alert("You're not logged in!");
      return;
    }

    const formData = new FormData();
    formData.append("token", userToken);
    formData.append("post_text", postText);
    formData.append("visibility", visibility);
    formData.append("post_type", post_type);
    formData.append("reaction", rea);

    if (imageFile) {
      formData.append("image", imageFile);
    }

    try {
      const response = await fetch("../../handlers/upload-post.php", {
        method: "POST",
        body: formData,
      });

      const result = await response.json();

      if (result.status === "success") {
        alert("Post created successfully!");
      } else {
        console.log(`Error: ${result.message}`);
      }
    } catch (error) {
      console.error("Failed to create post:", error);
      alert("An error occurred while creating the post.");
    }
  }

  // Example usage — bind to button click
  publisher.addEventListener("click", () => {
    let postText = document.getElementById("textArea").value.trim();
    const imageFile = document.getElementById("upload-photo").files[0];
    let feels = [
      "سعيد",
      "حزين",
      "غاضب",
      "متفاجئ",
      "خائف",
      "متحمس",
      "مستاء",
      "مرتاح",
      "مندهش",
      "فخور",
    ];
    if (feel !== null) {
      console.log(feel);
      postText = `يشعر ب ${feels[feel]}`;
      
      console.log(postText);
    }
    if (postText.length === 0 && !imageFile) {
      alert("Post cannot be empty!");
      return;
    }

    if (postText.length === 0 && imageFile) {
      createPostWithImage("...", imageFile, visibility, postType, feel);
    }
    if (postText.length !== 0 && !imageFile) {
      createPostWithImage(postText, null, visibility, postType, feel);
    } if (postText.length !== 0 && imageFile) {
      createPostWithImage(postText, imageFile, visibility, postType, feel);
    }
    console.log(postText);
  });
}
//show posts 
(async () => {
  let postsContainer =document.querySelector(".posts");
  let res = await fetch(`../../handlers/getData.php?table=posts`);
  let data = await res.json();
  console.log(data);
  let maping = await data.map((ele,index) => {
    let visibility =ele.visibility
    let userName= ele.user_name
    let profilePic = ele.profile_path;
    let postPic = ele.image_path;
    console.log(ele.reaction);
    

    if (ele.reaction == null && ele.is_quistitionair == 0 ) {
      if (ele.image_path == "") {
        postPic = `../assets/media/imgs/no.jpg`
      }
      if (visibility == 0) {
        profilePic = `../assets/media/imgs/an.png`
      }
      postsContainer.innerHTML += `
        <div class="post col-12 mt-5">
            <div class="user-info col-12 d-flex justify-content-between align-items-center">
                <div class="info col-12 d-flex align-items-center gap-2 flex-wrap">
                    <div class="profile-pic"><img src="../${profilePic}" alt=""></div>
                    <div class="profile-inf">
                        <div class="profile-name">${userName}</div>
                        <div class="post-date">${ele.date_added}</div>
                    </div>
                </div>
                <div class="options">
                    <button style="transform:rotate(90deg);">...</button>
                </div>
            </div>
            <div class="post-content mt-3 col-12">
                <div class="text col-12">${ele.post_text}</div>
                <div class="post-img mt-2 col-12">
                    <img src="../${postPic}" alt="">
                </div>
            </div>
            <div class="activity-center d-flex mt-2">
                <div class="likes"> like:<span>${ele.likes}</span></div>
                <div class="comments">comment:<span${ele.comments}</span> </div>
                <div class="shares">share:<span>${ele.shares}</span></div>
            </div>
            <div class="line-options d-flex justify-content-between align-items-center mt-2">
                <div class="option-1 d-flex align-items-center gap-1"><i class="fa-light fa-heart"></i>
                    <div class="option-text">like</div>
                </div>
                <div class="option-2 d-flex align-items-center gap-1"><i class="fa-light fa-comment"></i>
                    <div class="option-text">comment</div>
                </div>
                <div class="option-3 d-flex align-items-center gap-1"><i class="fa-light fa-share"></i>
                    <div class="option-text">share</div>
                </div>
                <div class="option-4 d-flex align-items-center gap-1"><i class="fa-light fa-messages"></i>
                    <div class="option-text">contact</div>
                </div>
            </div>
        </div>
      `
    }
  })
})();
//helper funcs
function close(clicker, box) {
  clicker.addEventListener("click", () => {
    box.classList.add("d-none");
  });
}
function openBoxes(clicker, box) {
  clicker.addEventListener("click", (e) => {
    box.classList.remove("d-none");
  });
}
