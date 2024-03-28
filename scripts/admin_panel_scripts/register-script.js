let profileLabel = document.querySelector(".main-wrapper form .divider input[type=file]");
let profile = document.querySelector(".main-wrapper form .divider .profile-label");
profileLabel.addEventListener("change",event => {
    // let url = profileImag
    let profileFile = profileLabel.files;
    let path = URL.createObjectURL(profileFile[0]);
    let profileImage = `background-image: url('${path}')`;
    profile.setAttribute("style",profileImage);
});