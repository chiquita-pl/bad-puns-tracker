<template>
    <div>
        <span class="help is-info"  v-if="isLoading">Loading...</span>
        <table class="table" v-else>
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Pun Count</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="movie in movies">
                <tr v-bind:key="movie.id">
                    <td>{{ movie.id }}</td>
                    <td>{{ movie.title }}</td>
                    <td>{{ movie.count }}</td>
                    <td>
                        <form @submit.prevent="onSubmitIncrease(movie)">
                            <button class="button is-primary" v-bind:class="{ 'is-loading' : isCountIncreaseUpdating(movie.id) }">Increase Count</button>
                        </form>
                        <form @submit.prevent="onSubmitDecrease(movie)">
                            <button class="button is-primary" v-bind:class="{ 'is-loading' : isCountDecreaseUpdating(movie.id) }">Decrease Count</button>
                        </form>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
        <movie-form @completed="addMovie"></movie-form>
    </div>
</template>

<script>
    import axios from 'axios'
    import Vue from 'vue'
    import MovieForm from './MovieForm.vue'
    export default {
        components: {
            MovieForm
        },
        data() {
            return {
                movies: {},
                isLoading: true,
                countUpdatingTable: []
            }
        },
        async created () {

            axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
            try {
                const response = await axios.get('http://localhost:8000/movies')
                this.movies = response.data
                this.isLoading = false
            } catch(e) {
                // handle authentication error here
            }
        },
        methods: {
            onSubmitIncrease(movie) {
                Vue.set(this.countUpdatingTable, movie.id, true)
                this.increaseCount(movie)
            },
            onSubmitDecrease(movie) {
                Vue.set(this.countUpdatingTable, movie.id, true)
                this.decreaseCount(movie)
            },
            async increaseCount(movie) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
                axios.post('http://localhost:8000/movies/' + movie.id + '/count')
                    .then(response => {
                        movie.count = response.data.count
                        this.countUpdatingTable[movie.id] = false
                    })
                    .catch(() => {
                        // handle authentication and validation errors here
                        this.countUpdatingTable[movie.id] = false
                    })
            },
            async decreaseCount(movie) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
                axios.post('http://localhost:8000/movies/' + movie.id + '/countdown')
                    .then(response => {
                        movie.count = response.data.count
                        this.countUpdatingTable[movie.id] = false
                    })
                    .catch(() => {
                        // handle authentication and validation errors here
                        this.countUpdatingTable[movie.id] = false
                    })
            },
            isCountIncreaseUpdating(id) {
                return this.countUpdatingTable[id]
            },
            isCountDecreaseUpdating(id) {
                return this.countUpdatingTable[id]
            },
            addMovie(movie) {
                this.movies.push(movie)
            }
        }
    }
</script>
