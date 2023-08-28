<script>
    export default {
        data() {
            return {

                waitCreate: false,
                waitPublish : false,

                defaultTitle : 'Create Marker',
                currentStep: 1,

                project_id : 462,

                errorMessage : '',

                marker: {
                    id : 0,
                    name : '',
                    image: null
                },

                files: {
                    image: null,
                    video : null
                }
            }
        },

        methods: {

            handleFileChange($event, type)
            {
                this.files[type] = $event.target.files[0];
            },

            createMarker: function(resp, hasError = false)
            {
                if(!resp.data || !resp.data.c || hasError)
                {
                    this.waitCreate = false;
                    this.errorMessage = 'Please fill all required fields!';
                    return;
                }

                this.currentStep = 2;

                this.marker = resp.data.marker;

                this.errorMessage = '';
            },

            createMarkerEvent()
            {
                if(this.waitCreate) return false;
                this.waitCreate = true;

                const formData = new FormData();
                formData.append('image', this.files.image);
                formData.append('project_id', this.project_id);
                formData.append('name', this.marker.name);

                axios.post('/overly/marker/create', formData)
                    .then(response => {
                        this.createMarker(
                            response
                        );
                    })
                    .catch(error => {
                        this.createMarker(
                            error, true
                        );
                    });

            },

            publishMarker(resp, hasError = false)
            {
              if(!hasError)
              {
                  this.currentStep = 3;
                  return;
              }

                this.errorMessage = 'Something went wrong....';
                this.waitPublish = false;
            },


            publishMarkerEvent()
            {
                if(this.waitPublish) return;
                this.waitPublish = true;

                const formData = new FormData();
                formData.append('marker_id', this.marker.id);
                formData.append('video', this.files['video']);

                axios.post('/overly/upload/marker/video', formData)
                    .then(response => {
                        this.publishMarker(
                            response
                        );
                    })
                    .catch(error => {
                        this.publishMarker(
                            error, true
                        );
                    });

            },
        },


        computed: {
            boxTitle()
            {
                return this.marker.id < 1 ? this.defaultTitle : this.marker.name;
            }
        }
    }
</script>

<template>
    <div class="container py-3">
        <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                {{ boxTitle }}
            </div>
            <div class="card-body py-3" v-if="currentStep == 1">
                <div class="form-group">
                    <label>Marker Name</label>
                    <input type="text" class="form-control" v-model="marker.name"/>
                </div>
                <div class="form-group">
                    <label>Marker Image</label>
                    <input type="file" class="form-control" v-on:change="handleFileChange($event, 'image')" ref="marker-image" name="image"/>
                </div>
                <div class="form-group">

                    <div v-if="errorMessage && errorMessage.length > 0" class="text-danger">
                        {{errorMessage}}
                    </div>

                    <button class="btn btn-primary" v-on:click.prevent="createMarkerEvent">
                        Next
                    </button>
                </div>
            </div>

            <div class="card-body py-3" v-if="currentStep == 2 || currentStep == 3">
                <div class="form-group">
                    <img :src="marker.image" class="marker-image"/>
                </div>
                <div class="form-group" v-if="currentStep == 2">
                    <label>Choose marker video</label>
                    <input type="file" class="form-control" v-on:change="handleFileChange($event, 'video')" ref="marker-image" name="video"/>
                </div>

                <div class="form-group">
                    <div v-if="errorMessage && errorMessage.length > 0" class="text-danger">
                        {{errorMessage}}
                    </div>

                    <button class="btn btn-primary" v-on:click.prevent="publishMarkerEvent" v-if="currentStep == 2">
                        Publish Marker
                    </button>
                    <div v-else>
                        You can scan marker now!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .container{
        max-width:600px;
    }

    .form-group{
        margin-bottom:15px;
    }

    .marker-image{
        max-width:100%;
        width:100%;
    }
</style>
