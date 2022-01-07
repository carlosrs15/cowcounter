function limitaTotal (evt) {
    var input = evt.target;
    var value = input.value;

    if (value.length <= 3) {
        return;
    }

    input.value = input.value.substr(0, 3); 
} 