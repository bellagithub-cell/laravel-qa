<script>
export default {
    props: ['answer'],
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
            
            if(confirm('Are you sure?')){
                axios.delete(this.endpoint)
                .then(res => {
                    // pas delete sukses, kita perlu remove answer dari DOM 
                    // dan show pesan balik dari servernya
                    $(this.$el).fadeOut(500, () =>{
                        // alert(res.data.message);
                        this.$toast.success(res.data.message, "Success", { timeout:3000 });
                    })
                    // durasi yg 500
                });
            }
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