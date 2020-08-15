<template>
    <!-- {{-- mark the question as favorite --}} -->
    <a title="Click to mark as favorite question (CLick again to undo)" 
    :class="classes" @click.prevent="toggle">
        <!-- {{-- ganti fontawesome --}} -->
        <i class="fas fa-star fa-2x"></i>

        <!-- {{-- how many people favorite this question --}} -->
        <span class="favorites-count">{{ count }}</span>
    </a>
</template>

<script>
export default {
    props: ['question'],

    data () {
        return {
            isFavorited: this.question.is_favorited,
            count: this.question.favorites_count,
            // signedIn: false,
            id: this.question.id
        }
    },

    computed: {
        // meethod to put auth logic
        classes () {
            return [
                'favorite', 'mt-2', 
                ! this.signedIn ? 'off' : (this.isFavorited ? 'favorited' : '')
            ];
        },

        endpoint () {
            return `/questions/${ this.id }/favorites`;
        }

        // signedIn () {
        //     return window.Auth.signedIn;
        // }
    },

    methods : {
        toggle(){
            // check if user not signin
            if( !this.signedIn){
                this.$toast.warning("Please login to favorite this question", "Warning", {
                    timeout: 3000,
                    // flash message
                    position: 'bottomLeft'
                });
                // supaya code di luar if gk terus2an di execute
                return; 
            }
            this.isFavorited ? this.destroy() : this.create();
        },

        destroy () {
            axios.delete(this.endpoint)
            .then(res => {
                this.count--;
                this.isFavorited = false;
            });
            
        },

        create () {
            axios.post(this.endpoint)
            .then(res => {
                this.count++;
                this.isFavorited = true;
            });
        }
    }
}
</script>