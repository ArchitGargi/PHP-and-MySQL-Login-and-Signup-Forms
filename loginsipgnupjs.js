// Get the modal
var modal = document.getElementById('id01');
var modal1 = document.getElementById('id02');
function login() {
var modal = document.getElementById('id01');
modal.style.display="block";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
}
}
// Get the modal
var modal1 = document.getElementById('id02');
function signup() {
var modal = document.getElementById('id02');
modal.style.display="block";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
}
}