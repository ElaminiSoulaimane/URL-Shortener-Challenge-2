<template>
    <div>
        <h2>Basic Stats</h2>
        <p>Total Visits: <span class="badge rounded-pill bg-success"> {{ totalVisits }}</span></p>

        <h2>Most Visited URLs</h2>
    

        <table class="table">
            <thead class="table-dark" >
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Short URL</th>
                    <th scope="col">Original URL</th>
                    <th scope="col">Visits</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="url in mostVisitedUrls" :key="url.id">
                    <th scope="row"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-cursor" viewBox="0 0 16 16">
                            <path
                                d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z" />
                        </svg></th>
                    <td class="text-primary"> <a class="text-decoration-none" :href="base_url + url.short_url"
                            @click.prevent="openLinkInNewWindow(base_url + url.short_url)">{{ base_url + url.short_url
                            }}</a></td>
                    <td>{{ truncate(url.long_url, 80) }}</td>

                    <td>{{ url.click_count }}</td>
                </tr>

            </tbody>
        </table>


    </div>
</template>
  

<script>
import axios from 'axios';

export default {

    data() {
        return {
            base_url: 'http://127.0.0.1:8000/',
            urls: [],
        };
    },
    computed: {
        totalVisits() {
            return this.urls.reduce((total, url) => total + url.click_count, 0);
        },

        mostVisitedUrls() {
            return [...this.urls].sort((a, b) => b.click_count - a.click_count).slice(0, 100);
        }
    },
    methods: {
        truncate(text, length) {
            console.log(text, length);
            if (typeof text !== 'string') {
                console.error('text is not a string:', text);
                return '';
            }

            if (text.length <= length) {
                return text;
            } else {
                return text.slice(0, 80) + (text.length > 80 ? '...' : '');
            }
        },

        openLinkInNewWindow(link) {
            window.open(link, '_blank');
            location.reload();
        },
        getUrls() {
            axios.get('http://localhost:8000/api/urls')
                .then(response => {
                    this.urls = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
    mounted() {
        this.getUrls();
    }
};
</script>
  