const inputs = document.querySelectorAll("input");

const patterns = {
    denomination: /^[a-z\d]{5,12}$/i,
}

// Validation function
function checking(field, regex){
    if(regex.test(field.value)){
        field.className='valid';
    }
    else{
        field.className='invalid';
    }
}

inputs.forEach((input) =>{
    input.addEventListener("keyup", (e) =>{
        checking(e.target, patterns[e.target.attributes.name.value]);
    });
});