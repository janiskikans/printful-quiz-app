<template>
    <div>

        <div class="card bg-secondary">
            <div class="card-body">

                <h4 class="mb-3"><i class="fa fa-history"></i> Your Quiz History</h4>

                <p>Underneath you can see you latest completed quizzes.</p>

                <div v-if="attempts.length > 0">
                    <div class="card mb-3" v-for="attempt in attempts" :key="key" v-if="attempts.length > 0">
                        <div class="card-header bg-secondary">
                            {{ getQuizTitle(attempt.quizId) }}<span class="float-right text-primary">{{ attempt.quizTakenAt }}</span>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="card mb-3">
                        <div class="card-header bg-secondary">
                           <strong>You have no completed quizzes yet</strong>. Try starting a new quiz.
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            attempts: {
                default: [],
                required: true,
            },

            quizzes: {
                default: [],
                required: true,
            }
        },

        methods: {
            getQuizTitle(attemptQuizId) {
                return this.quizzes[attemptQuizId - 1].title;
            }
        }
    }
</script>