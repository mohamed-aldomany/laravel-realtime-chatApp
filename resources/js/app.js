require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueChatScroll);
import VueChatScroll from 'vue-chat-scroll';

import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'

Vue.use(Toaster, {
    timeout: 5000
})


Vue.component('message', require('./components/Message.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        message : '',
        chat : {
            message : [],
            user : [],
            color : [],
            time: [],
            typing : ''
        },
        numberOfUsers : 0
    },
    methods: {
        send(){
            if(this.message.length != 0){
                this.chat.message.push(this.message);
                this.chat.user.push('you');
                this.chat.color.push('success');
                this.chat.time.push(this.getTime());
                axios.post('/send', {
                    message: this.message,
                })
                .then(response => {
                    this.message="";
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
            }
        },
        getTime(){
            let time = new Date();
            return time.getHours()+':'+time.getMinutes()
        }
    },
    watch: {
        message(){
            Echo.private('chat')
                .whisper('typing', {
                    name: this.message
                });
        }
    },
    mounted() {
        Echo.private('chat')
            .listen('ChatEvent', (e) => {
                this.chat.message.push(e.message);
                this.chat.user.push(e.user);
                this.chat.color.push('danger');
                this.chat.time.push(this.getTime());
            })
            .listenForWhisper('typing', (e) => {
                if(e.name!=''){
                    this.chat.typing = 'typing...'
                }else{
                    this.chat.typing = ''
                }
            });

        Echo.join(`chat`)
            .here((users) => {
                this.numberOfUsers = users.length;
            })
            .joining((user) => {
                this.numberOfUsers += 1;
                this.$toaster.success(user.name+'is joining the room.')
            })
            .leaving((user) => {
                this.numberOfUsers -= 1;
                this.$toaster.warning(user.name + 'is leaving the room.')
            });
    },
});
