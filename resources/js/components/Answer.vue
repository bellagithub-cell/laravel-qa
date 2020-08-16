<template>
    <div class="media post">
        <vote :model="answer" name="answer"></vote>
        
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea rows="10" v-model="body" class="form-control" required></textarea>
                </div>
                <button  class="btn btn-primary" :disabled="isInvalid">Update</button>
                <button  class="btn btn-outline-secondary" @click="cancel" type="button">Cancel</button>
            </form>
           <div v-else>
            <div v-html="bodyHtml"></div>
            <!-- {{-- {!! $answer->body_html !!} --}} -->
            <div class="row">
                <div class="col-4">
                    <div class="ml-auto">
                        <!-- {{-- auth user supaya button edit gk muncul --}} -->
                        <!-- {{-- bisa juga pakai ini --}} -->
                        <a v-if="authorize('modify', answer)" @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                        <button v-if="authorize('modify', answer)" @click="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                    </div>
                  </div>
                <div class="col-4">
                </div>
                <!-- {{-- add other info and creation date --}} -->
                <div class="col-4">
                    <!-- {{-- pindah ke _author.blade --}} -->
                    <!-- {{-- @include('shared._author', [
                        'model' => $answer,
                        'label' => 'answered'
                    ]) --}} -->
    
                    <!-- {{-- add component --}} -->
                    <user-info :model="answer" label="Answered"></user-info>
                </div>
            </div>
           </div>  
        </div>
    </div>  
</template>

<script>
import Vote from './Vote.vue';
import UserInfo from './UserInfo.vue';

export default {
    props: ['answer'],

    components: { Vote, UserInfo},
    
    data () {
        return {
            editing: false,
            body: this.answer.body,
            bodyHtml: this.answer.body_html,
            id: this.answer.id,
            questionId: this.answer.question_id,
            beforeEditCache: null
        }
    },
    methods: {
        edit () {
            this.beforeEditCache = this.body;
            this.editing = true;
        },
        cancel () {
            this.body = this.beforeEditCache;
            this.editing = false;
        },
        update () {
            axios.patch(this.endpoint, {
                body: this.body
            })
            .then(res => {  
                // console.log(res);              
                this.editing = false;
                this.bodyHtml = res.data.body_html;
                // alert(res.data.message);
                this.$toast.success(res.data.message, "Success", { timeout:3000 });
            })
            .catch(err => {
                // console.log(err.response);
                this.$toast.error(err.response.data.message, "Error", { timeout:3000 });
                // alert(err.response.data.message);                
            });
        },  
          
        destroy(){
            this.$toast.question('Are you sure about that?', "Confirm", {
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Hey',
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', (instance, toast) => {
                        axios.delete(this.endpoint)
                        .then(res => {
                            this.$emit('deleted')
                            
                        });
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                    }, true],
                    ['<button>NO</button>', function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
        
                    }],
                ]
            });

            // if(confirm('Are you sure?')){
            //     axios.delete(this.endpoint)
            //     .then(res => {
            //         // pas delete sukses, kita perlu remove answer dari DOM 
            //         // dan show pesan balik dari servernya
            //         $(this.$el).fadeOut(500, () =>{
            //             // alert(res.data.message);
            //             this.$toast.success(res.data.message, "Success", { timeout:3000 });
            //         })
            //         // durasi yg 500
            //     });
            // }
        }
    },
    computed: {
        isInvalid () {
            return this.body.length < 10;
        },

        endpoint(){
            return `/questions/${this.questionId}/answers/${this.id}`;
        }
    }
}
</script>