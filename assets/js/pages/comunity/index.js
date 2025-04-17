const userToken = document.cookie
  .split("; ")
  .find((row) => row.startsWith("token="))
  ?.split("=")[1];

if (!userToken) {
  alert("You're not logged in!");
}
let publisher;
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
    createPost();
  });
  close(document.querySelector(".feelings-box .closer i"), emojyBox);
})();
//open and close polls and manage it
(() => {
  let pollBoxOpenr = document.querySelector(".button-1");
  let pollBox = document.querySelector(".addd-quistitionair-container");
  openBoxes(pollBoxOpenr, pollBox);
  close(document.querySelector(".addd-quistitionair .closer i"), pollBox);
  let optionsBox = document.querySelector(".choises");
  let titleInp = document.querySelector(".q-title");
  let optionInp = document.querySelector(".q-option");
  let optionAdd = document.querySelector(".add-option");
  let options = [];
  let save = document.querySelector(".save-quistitionaire");
  optionAdd.addEventListener("click", async (e) => {
    if (optionInp.value.trim() != "") {
      optionsBox.innerHTML += `
        <div class="choise col-12 d-flex align-items-center justify-content-between p-2 mt-1 flex-wrap">
                    <div class="text">${optionInp.value.trim()}</div>
                    <div class="delete"><i class="fa-solid fa-trash"></i></div>
                </div>
      `;
      options.push(optionInp.value.trim());
      console.log(options);
      optionInp.value = "";
      //deleteOptions
      let deleteEles = document.querySelectorAll(".choise .delete i");
      deleteEles.forEach((ele) => {
        ele.addEventListener("click", (e) => {
          let choiceElement = e.target.closest(".choise");
          let index = Array.from(choiceElement.parentElement.children).indexOf(
            choiceElement
          );
          if (index !== -1) {
            options.splice(index, 1);
            choiceElement.remove();
          }
          deleteEles = document.querySelectorAll(".choise .delete i");
        });
      });
    }
  });
  save.addEventListener("click", async (e) => {
    if (options.length == 0 || titleInp.value.trim() == "") {
      Swal.fire({
        icon: "warning",
        title: "يرجى ملء جميع البيانات",
      });
    } else {
      const data = {
        question: titleInp.value.trim(),
        options: options,
        expiration_days: 100000,
      };
      try {
        const response = await fetch("../../handlers/pools.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
        });

        const result = await response.json();
        if (result.success) {
          console.log("Poll created successfully:", result);
        } else {
          console.error("Error:", result.message);
        }
      } catch (error) {
        console.error("Error during fetch:", error);
      }
      let formData = new FormData();
      formData.append("token", userToken);
      formData.append("post_text", "");
      formData.append("visibility", 3);
      formData.append("reaction", -1);
      try {
        const response = await fetch("../../handlers/upload-post.php", {
          method: "POST",

          body: formData,
        });
      } catch (error) {
        console.error("Error during fetch:", error);
      }
    }
  });
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

  let feel = -1;
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

    if (feel !== -1) {
      postText = `يشعر ب ${feels[feel]}`;
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
    }
    if (postText.length !== 0 && imageFile) {
      createPostWithImage(postText, imageFile, visibility, postType, feel);
    }
  });
}
//upload polls
async function createPolls(title, options) {
  if (!title || options.length < 2) {
    alert("Please enter a title and at least two options.");
  }

  const pollData = {
    title: title,
    options: options,
  };

  try {
    const response = await fetch("upload_poll.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(pollData),
    });

    const result = await response.json();

    if (result.success) {
      alert("Poll uploaded successfully!");
    } else {
      alert("Error: " + result.message);
    }
  } catch (error) {
    console.error("Error uploading poll:", error);
  }
}
//show posts
async function showPosts() {
  let postsContainer = document.querySelector(".posts");
  let res = await fetch(
    `../../handlers/getData.php?table=posts&order_dir=DESC`
  );
  let data = await res.json();

  let maping = await data.map((ele, index) => {
    let visibility = ele.visibility;
    let userName = ele.user_name;
    let profilePic = ele.profile_path;
    let postPic = ele.image_path;
    let emojies = [
      '<i class="fas fa-smile" style="color:#ffff00;"></i>', // سعيد
      '<i class="fas fa-sad-tear" style="color:#ffa500;"></i>', // حزين
      '<i class="fas fa-angry" style="color:#ff0000;"></i>', // غاضب
      '<i class="fas fa-surprise" style="color:#ffb6c1;"></i>', // متفاجئ
      '<i class="fas fa-flushed" style="color:#87ceeb;"></i>', // خائف
      '<i class="fas fa-grin-stars" style="color:#00ff00;"></i>', // متحمس
      '<i class="fas fa-frown" style="color:#808080;"></i>', // مستاء
      '<i class="fas fa-smile-beam" style="color:#add8e6;"></i>', // مرتاح
      '<i class="fas fa-meh-blank" style="color:#d3d3d3;"></i>', // مندهش
      '<i class="fas fa-grin-hearts" style="color:#ff69b4;"></i>',
    ];

    if (ele.image_path == "") {
      postPic = `../assets/media/imgs/no.jpg`;
    }
    if (visibility == 0) {
      profilePic = `../assets/media/imgs/an.png`;
      userName = "Unknown";
    }

    if (ele.reaction == -1 && +ele.visibility !== 3) {
      postsContainer.innerHTML += `
        <div class="post col-12 mt-5" data-postid="${ele.id}">
            <div class="user-info col-11 d-flex justify-content-between align-items-center">
                <div class="info col-12 d-flex align-items-center gap-2 flex-wrap">
                    <div class="profile-pic"><img loading="lazy" src="../${profilePic}" alt=""></div>
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
                    <img src="../${postPic}"loading="lazy" alt="">
                </div>
            </div>
            <div class="activity-center d-flex mt-2">
                <div class="likes"> like:<span>${ele.likes}</span></div>
                <div class="comments">comment:<span${ele.comments}</span> </div>
                <div class="shares">share:<span>${ele.shares}</span></div>
            </div>
            <div class="line-options d-flex justify-content-between align-items-center mt-2">
                <div class="option-1 d-flex align-items-center gap-1"><i class="fa-light fa-heart" id="likeButton"></i>
                    <div class="option-text">like</div>
                </div>
                <div class="option-2 d-flex align-items-center gap-1" data-postid="${ele.id}"><i class="fa-light fa-comment" data-postid="${ele.id}"></i>
                    <div class="option-text"data-postid="${ele.id}">comment</div>
                </div>
                <div class="option-3 d-flex align-items-center gap-1"><i class="fa-light fa-share"></i>
                    <div class="option-text">share</div>
                </div>
                <div class="option-4 d-flex align-items-center gap-1"><i class="fa-light fa-messages"></i>
                    <div class="option-text">contact</div>
                </div>
            </div>
        </div>
      `;
    }
    if (+ele.reaction !== -1 && +ele.visibility !== 3) {
      postsContainer.innerHTML += `
         <div class="post col-12 mt-5" data-postid="${ele.id}">
            <div class="user-info col-11 d-flex justify-content-between align-items-center">
                <div class="info col-12 d-flex align-items-center gap-2 flex-wrap">
                    <div class="profile-pic"><img src="../${profilePic}" loading="lazy" alt=""></div>
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
                <div class="text col-12">${ele.post_text}..${
        emojies[ele.reaction]
      }</div>
      <div class="img col-12"><span></span></div>
      </di>
      </div>
<div class="activity-center d-flex mt-2">
                <div class="likes"> like:<span>${ele.likes}</span></div>
                <div class="comments">comment:<span${ele.comments}</span> </div>
                <div class="shares">share:<span>${ele.shares}</span></div>
            </div>
            <div class="line-options d-flex justify-content-between align-items-center mt-2">
                <div class="option-1 d-flex align-items-center gap-1"><i class="fa-light fa-heart" id="likeButton"></i>
                    <div class="option-text">like</div>
                </div>
                <div class="option-2 d-flex align-items-center gap-1" data-postid="${
                  ele.id
                }"><i class="fa-light fa-comment" data-postid="${ele.id}"></i>
                    <div class="option-text"data-postid="${
                      ele.id
                    }">comment</div>
                </div>
                <div class="option-3 d-flex align-items-center gap-1"><i class="fa-light fa-share"></i>
                    <div class="option-text">share</div>
                </div>
                <div class="option-4 d-flex align-items-center gap-1"><i class="fa-light fa-messages"></i>
                    <div class="option-text">contact</div>
                </div>
            </div>
                </div>
       `;
    }
    if (+ele.reaction == -1 && +ele.visibility == 3 && ele.post_text == "") {
      postsContainer.innerHTML += `<div></div>`
    }
  });
}
//manage likes
document.addEventListener("DOMContentLoaded", async () => {
  let waiting = await showPosts();
  handleLikes();
  handleComments();
});
async function handleLikes() {
  const likeButtons = document.querySelectorAll("#likeButton");

  likeButtons.forEach((button) => {
    button.addEventListener("click", async () => {
      const postId =
        button.parentElement.parentElement.parentElement.getAttribute(
          "data-postid"
        );
      const likeCount =
        button.parentElement.parentElement.previousElementSibling
          .firstElementChild.lastElementChild;

      try {
        const response = await fetch("../../handlers/likes.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: `post_id=${postId}`,
        });

        const data = await response.json();

        if (data.status === "success") {
          if (data.action === "liked") {
            button.classList.add("liked");
            button.classList.replace("fa-light", "fa-solid");
            likeCount.textContent = parseInt(likeCount.textContent) + 1;
          } else if (data.action === "unliked") {
            button.classList.remove("liked");
            button.classList.replace("fa-solid", "fa-light");
            likeCount.textContent = parseInt(likeCount.textContent) - 1;
          }
        } else {
          alert(data.message);
        }
      } catch (error) {
        console.error("Error:", error);
        alert("Failed to process like action.");
      }
    });
  });
}
async function handleComments() {
  let post_id = null;
  let commentsButtons = document.querySelectorAll(".option-2");
  commentsButtons.forEach((ele, index) => {
    ele.addEventListener(
      "click",
      openBoxes(ele, document.querySelector(".add-comment-container"))
    );
    ele.addEventListener(
      "click",
      close(
        document.querySelector(".add-comment .closer i"),
        document.querySelector(".add-comment-container")
      )
    );
    ele.onclick = (e) => (post_id = e.target.dataset.postid);
  });
  let commentText = document.querySelector(".add-comment textarea");
  let commentPublisher = document.querySelector(".add-comment button");
  if (commentText.value.trim !== "") {
    commentPublisher.addEventListener("click", () => {
      let commentImg = document.getElementById("add-comment-photo").files[0];
      addComment(post_id, commentText.value, null, commentImg);
    });
  }
}

//helper funcs
async function close(clicker, box) {
  clicker.addEventListener("click", () => {
    box.classList.add("d-none");
  });
}
async function openBoxes(clicker, box) {
  clicker.addEventListener("click", (e) => {
    box.classList.remove("d-none");
  });
}

//comments controlle

async function addComment(
  postId,
  commentText,
  parentId = null,
  commentImg = null
) {
  const formData = new FormData();
  formData.append("post_id", postId);
  formData.append("comment_text", commentText);
  formData.append("comment_img", commentImg);
  if (parentId) formData.append("parent_id", parentId);

  const response = await fetch("../../handlers/comments.php", {
    method: "POST",
    credentials: "include", // Ensures cookies (JWT token) are sent
    body: formData,
  });

  const data = await response.json();
}
