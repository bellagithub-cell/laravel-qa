<template>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#write">Write</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#preview">Preview</a>
                </li>
            </ul>
        </div>
        <div class="card-body tab-content">
            <div class="tab-pane active" id="write">
                <slot></slot>
            </div>
            <div class="tab-pane" id="preview" v-html="preview"></div>
        </div>
    </div>
</template>

<script>
import MarkdownIt from 'markdown-it';
import prism from 'markdown-it-prism';
import autosize from 'autosize';

// to hold markdown instance
const md = new MarkdownIt();
md.use(prism);

export default {
    props: ['body'],

    computed: {
        preview () {
            return md.render(this.body);
        }
    },

    // watch: {
    //     body: function (){
    //         console.log('watch body');
    //     }
    // },

    mounted (){
        autosize(this.$el.querySelector('textarea'))
    },

    updated (){
        // console.log('updated hook');
        autosize(this.$el.querySelector('textarea'))
    }
}
</script>