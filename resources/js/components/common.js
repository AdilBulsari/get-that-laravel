export default {
    data() {
        return {};
    },
    methods: {
        async callApi(methodType,url,data) {
            try {
           return  await  axios({
                    method:methodType,
                    url,
                    data
                });
            } catch(e) {

                return e.response
            }
        },
        info (title,desc ="hey") {
            this.$Notice.info({
                title: title,
                desc: desc 
            });
        },
        success (title,desc) {
            this.$Notice.success({
                title: title,
                desc: desc 
            });
        },
        warning (title,desc ="Oops!") {
            this.$Notice.warning({
                title: title,
                desc: desc 
            });
        },
        error (title,desc) {
            this.$Notice.error({
                title: title,
                desc: desc 
            });
        }

    },
};
