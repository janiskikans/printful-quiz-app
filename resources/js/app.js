import Vue from 'vue';

// Import quiz component.
// Vue.component('quiz', require('./vue-components/quiz/components/main').default);

// Import quiz-create component.
// Vue.component('quiz-create', require('./vue-components/quiz-create/components/main').default);

var Quiz = require('./vue-components/quiz/components/main').default;
var QuizCreate = require('./vue-components/quiz-create/components/main').default;

new Vue({
    el: '#app',
    components: {
        'quiz': Quiz,
        'quiz-create': QuizCreate
    }
});