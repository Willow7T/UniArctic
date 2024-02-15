import './bootstrap';

window.submitForm = function() {
    document.getElementById('searchForm').submit();
}
window.previewImage = function(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('imagePreview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
window.previewDocxFileName = function(event) {
    var fileName = event.target.files[0].name;
    document.getElementById('contentPreview').innerText = fileName;
}