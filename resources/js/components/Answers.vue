<template>
    <div>
        <div class="row mt-4 v-cloak" v-if="count">
            <div class="col-md-12">
                <!-- {{-- utilize bootstrap component --}} -->
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <!-- {{-- total number answer of the curr question --}} -->
                            <h2>{{ title }}</h2>
                        </div>
                        <hr>
                        <answer @deleted="remove(index)" v-for="(answer, index) in answers" :answer="answer" :key="answer.id">

                        </answer>
                        
                        <!-- untuk load more answer -->
                        <div class="text-center mt-3" v-if="nextUrl">
                            <button @click.prevent="fetch(nextUrl)" class="btn btn-outline-secondary">Load more answer</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <new-answer @created="add" :question-id="question.id"></new-answer>
    </div>
</template>

<script>
import Answer from './Answer.vue';
import NewAnswer from './NewAnswer.vue';

export default {
    props: ['question'],


    data(){
        return {
            questionId: this.question.id, // for hold question id
            count: this.question.answers_count, // hold answer count from question instance
            answers: [], // store all answers
            nextUrl: null
        }

    },

    created(){
        this.fetch(`/questions/${this.questionId}/answers`);
    },

    methods: {
        add (answer){
            this.answers.push(answer);
            this.count++;
        },

        // parent can sent data tp child through custom properties 
        // and a child can send data up to the parent through custom events
        remove(index){
            this.answers.splice(index, 1);
            // decrement count 
            this.count--;
        },

        fetch(endpoint){
            axios.get(endpoint)
            .then(({ data }) => {
                // console.log(res);
                this.answers.push(... data.data);
                this.nextUrl = data.next_page_url;

            })
        }
    },

    computed: {
        title() {
            return this.count + " " + (this.count > 1 ? 'Answers' : 'Answer' );
        }
    },

    components: {
        Answer,
        NewAnswer
    }
}
</script>