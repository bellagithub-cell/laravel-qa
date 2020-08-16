<template>
    <!-- {{-- buat answernya --}} -->
<div class="row mt-4">
    <div class="col-md-12">
        <!-- {{-- utilize bootstrap component --}} -->
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your Answer </h3>
                </div>
                <hr>
                <!-- {{-- form buat answer --}} -->
                <form @submit.prevent="create">
                    <div class="form-group">
                        <!-- {{-- show validation error messages with $error --}} -->
                        <textarea required v-model="body" name="body" cols="30" rows="7" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" :disabled="isInvalid" class="btn btn-lg btn-outline-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['questionId'],

    methods: {
        create (){
            axios.post(`/questions/${this.questionId}/answers`, {
                body: this.body
            })
            .catch(error => {
                this.$toast.error(error.response.data.message, "Error");
            })
            .then(({data}) => {
                this.$toast.success(data.message, "Success");
                this.body = '';
                // custom event
                this.$emit('created', data.answer);
            })
        }
    }, 

    data () {
        return {
            body: ''
        }
    }, 

    computed: {
        isInvalid () {
            // check it user not signin
            return !this.signedIn || this.body.length < 10;
        }
    }
}
</script>