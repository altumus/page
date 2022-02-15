const app = {
    data(){
        return{
            inputValue : ''
        }
    },

    methods: {
        check(){
            if(this.inputValue.length == 0){
                alert('Нельзя оставить пустой комментарий');
            }
        },
    }
}

Vue.createApp(app).mount('#app');