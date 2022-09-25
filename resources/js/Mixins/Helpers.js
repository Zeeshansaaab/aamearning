import moment from 'moment';

export default {
    methods: {
        // // formate time
        formatDate(dateString) {
            return moment(dateString).format("Do MMM YYYY");
        },
        // // formate date & time
        // formatDateTime(dateString) {
        //     return moment(dateString).format("Do MMM YYYY h:mm:ss A");
        // },
        // // formate date & time Unix
        // formatDateTimeUnix(dateString) {
        //     return moment.unix(dateString).format("Do MMM YYYY h:mm:ss A");
        // },

        // generic function to get images
        getImage(path, isSaved = true, type = 'avatar', isExternal = 0) {
            const baseUrl = window.location.protocol + "//" + window.location.host
            if (isExternal) {
                return path
            } else {
                return this.$page.props.ziggy.url + '/storage/' + path
            }
            
        },

        //to get placeholder urls
        placeHolderUrls(type) {
            var url = ''
            switch(type) {
                case 'department':
                case 'category':
                case 'product':
                case 'variant':
                case 'news':
                    url = '/images/placeholder.png'
                    break
                case 'avatar':
                    url = '/images/no_avatar.jpg'
                    break
                case 'banner':
                    url = '/images/cover.jpg'
                    break
                case 'logo':
                    url = '/images/placeholder.png'
                    break
                case 'thumbnail':
                    url = '/images/placeholder.png'
                    break
            }
            return url
        },

        // get role full name
        getRoleName(role) {
            const Name = role.replace('_', ' ');
            return Name.charAt(0).toUpperCase() + Name.slice(1);
        },

        // check user permissions
        checkUserPermissions(value) {
            const permissionsArray = this.$page.props.auth.user.permissions;
            // for single record
            if (typeof value == 'string') {
                return permissionsArray.includes(value);
            }

            // for array of permissions
            if (typeof value == 'object') {
                var result = false;
                value.forEach(element => {
                    let response = permissionsArray.includes(element);
                    if (response) {
                        return result = response;
                    }
                });
                return result;
            }
        },

        // conversion to boolean values
        booleanStatusValue(status) {
            var value = false;
            switch (status) {
                case 'active':
                    value = true
                    break;
                case '1':
                    value = true
                    break;
                case 1:
                    value = true
                    break;
                default:
                    break;
            }
            return value
        },

        // conversion to required boolean values
        booleanRequiredValue(required) {
            var value = false;
            switch (required) {
                case 1:
                    value = true
                    break;

                default:
                    break;
            }
            return value
        },

        // get group name
        getGroupName(group) {
            return group ? group.replaceAll('_', ' ') : null;
        },
        setTypeFormat(value){
            return value.replaceAll("_"," ");
        },
        getStatusForTable(status){
            if(status == 'active' || status == 1){
                return 'badge--success';
            }else if(status == 'inactive' || status == 0) {
                return 'badge--danger';
            }else {
                return 'badge--warning';
            }
        },
        getStatusWithBoolean(status){
            switch(status){
                case 1:
                    return 'active'
                case 0:
                    return 'inactive'
                default :
                    return 'pending'
                    
            }
            
        },
        showTooltip(){
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        },

        hideTooltip() {
            $('[data-bs-toggle="tooltip"]').tooltip("hide");
        },

        getAmount(amount){
            if(amount > 0)
                return amount.toFixed(2);
            return 0;
        }

    }
}