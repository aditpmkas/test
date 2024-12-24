function formatInput(input) {
    let value = input.value.replace(/[^0-9]/g, '');
    if (value) {
        value = parseInt(value).toLocaleString('id-ID');
    }
    input.value = value;
}
function changeToNumber() {
    let input = document.getElementById('num');
    input.type = 'number';
    input.value = parseFloat(input.value) || ''; // Optional: Convert the existing value
}