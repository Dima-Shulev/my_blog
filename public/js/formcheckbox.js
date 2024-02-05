class FormCheckbox {

    checkInBox;

    CheckBox(){
       this.checkInBox = document.querySelector('#remember');
        this.checkInBox.addEventListener('click',(event)=>{
            this.checkInBox.value = event.target.value;
            if(this.checkInBox.value !== undefined){
                return this.checkInBox.value;
            }
        });
    }
}
