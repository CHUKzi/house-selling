var loadFile1 = function(event) {
  var image = document.getElementById('image1');
  image.src = URL.createObjectURL(event.target.files[0]);
};
var loadFile2 = function(event) {
  var image = document.getElementById('image2');
  image.src = URL.createObjectURL(event.target.files[0]);
};
var loadFile3 = function(event) {
  var image = document.getElementById('image3');
  image.src = URL.createObjectURL(event.target.files[0]);
};
var EditloadFile1 = function(event) {
  var image = document.getElementById('Eimage1');
  image.src = URL.createObjectURL(event.target.files[0]);
  $("div1").hide();
};
var EditloadFile2 = function(event) {
  var image = document.getElementById('Eimage2');
  image.src = URL.createObjectURL(event.target.files[0]);
  $("div2").hide();
};
var EditloadFile3 = function(event) {
  var image = document.getElementById('Eimage3');
  image.src = URL.createObjectURL(event.target.files[0]);
  $("div3").hide();
};
var oner = document.getElementById("lesilk");
if (oner) {} else {document.getElementById("html").hidden = true;}