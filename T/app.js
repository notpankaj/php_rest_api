const loginForm = document.querySelector(".login");
const signupForm = document.querySelector(".signup");
const logoutForm = document.querySelector(".logout");
const profileBox = document.querySelector(".profile");

function hideModal() {
  document.querySelector(".modal").style.display = "none";
}

// login
loginForm.addEventListener("submit", (e) => {
  e.preventDefault();

  let data = new FormData(loginForm);
  fetch("./php/login.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.json())
    .then((result) => {
      loadTable();
      profileBox.innerHTML = `<i>${result.name}</i>
        <form class="logout">
            <input type="hidden" name="user_id" value='${result.id}'>
            <button type="submit">logout</button>
        </form>`;
    });
});

// signup
signupForm.addEventListener("submit", (e) => {
  e.preventDefault();

  let data = new FormData(signupForm);
  fetch("./php/signup.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then((result) => {
      profileBox.innerHTML = `<i>${result.name}</i>
        <form class="logout">
            <input type="hidden" name="user_id" value='${result.id}'>
            <button type="submit">logout</button>
        </form>`;
    });
});

// logout
logoutForm.addEventListener("submit", (e) => {
  e.preventDefault();

  let data = new FormData(logoutForm);
  fetch("./php/logout.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then((result) => {
      console.log(result);
      profileBox.innerHTML = "";
    });
});

function loadTable() {
  fetch("./php/fetch-all.php")
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      let tr = "";
      data.forEach((post) => {
        tr += `
        <tr>
        <th scope="row">${post.id}</th>
        <td>${post.body}</td>
        <td><button onClick="editRecord(${post.id})">edit</button></td>
        <td><button onClick="deleteRecord(${post.id})">delete</button></td>
        </tr>`;
      });
      document.querySelector(".tbody").innerHTML = tr;
    });
}
loadTable();

function editRecord(id) {
  fetch("./php/fetch-post.php?post_id=" + id)
    .then((res) => res.json())
    .then((data) => {
      // console.log(data);
      document.querySelector(".modal").style.display = "block";
      document.querySelector("#edit-id").value = data[0].id;
      document.querySelector("#edit-body").value = data[0].body;
    });
}

// update
const editForm = document
  .querySelector(".editForm")
  .addEventListener("submit", updatePost);

function updatePost(e) {
  e.preventDefault();
  const post_id = document.querySelector("#edit-id").value;
  const post_body = document.querySelector("#edit-body").value;
  if (post_body == "" || post_id == "") {
    alert("post cannot be empty");
  } else {
    const formData = {
      post_id,
      post_body,
    };

    console.log(formData);

    fetch("./php/fetch-update.php", {
      method: "POST",
      body: JSON.stringify(formData),
      headers: {
        "Content-type": "application/json",
      },
    })
      .then((res) => res.text())
      .then((data) => {
        console.log(data);

        document.querySelector(".modal").style.display = "none";
        loadTable();
      });
  }
}

function deleteRecord(id) {
  fetch("./php/fetch-delete.php?delId=" + id, {
    method: "delete",
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.delete) {
        loadTable();
      }
    });
}

const addPostForm = document.querySelector(".addPostForm");
addPostForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const postBody = addPostForm.querySelector("input").value;
  if (postBody === "") {
    alert("post cannot be empty");
  }

  const data = JSON.stringify({ postBody });
  fetch("./php/fetch-add.php", {
    method: "post",
    body: data,
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      if ((data.insert = "insert successfully")) {
        loadTable();
        addPostForm.reset();
      }
    });
});
