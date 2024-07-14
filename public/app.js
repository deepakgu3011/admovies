document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('add-url').addEventListener('click', function () {
        var newInput = document.createElement('div');
        newInput.innerHTML = '<label for="url" style="width:auto;">Download Link</label><span><button type="button" class="remove-url btn btn-danger">-</button></span><input type="url" name="urls[]" id="urls[]"><label for="size">File Size</label><input type="text" name="size[]" id="">';
        document.getElementById('url-inputs').appendChild(newInput);

        // Add event listener to the new remove button
        newInput.querySelector('.remove-url').addEventListener('click', function () {
            newInput.remove();
        });
    });
});
window.onbeforeunload= function(){
    window.scrollTo(0,0);
};
