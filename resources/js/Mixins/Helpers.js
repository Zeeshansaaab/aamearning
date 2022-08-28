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

        // get sync categories
        syncedCategories(cat_id, business_categories) {
            var value = false;
            value =  business_categories.find(function (category) {
                if (category.id === cat_id) {
                    return true;
                }
            })
            return value;
        },

        // get side bar permissions
        sideBarPermissions (value) {
            var permission = false;
            let condition = localStorage.getItem("selectedModule");
            switch (condition) {
                case 'settings':
                    var permissionsList = [
                        'view_users_tab',
                        'view_drivers_tab',
                        'view_settings_tab',
                    ];
                    permission = permissionsList.includes(value);
                    break;
                case '1':
                    var permissionsList = [
                        'view_global_tags_tab',
                        'view_categories_tab',
                        'view_business_tab',
                        'view_products_tab',
                        'view_manufacturer_tab', // which will be use as brands
                        'view_orders_tab',
                        'view_categories_mapper_tab',
                        'view_standard_tag',
                        'view_tags_mapper_tab',
                        'view_industry_tag',
                        'view_global_tags',
                        'view_attributes'
                    ];
                    permission = permissionsList.includes(value);
                    break;
                default:
                    break;
            }
            return permission;
        },

        // get selected track
        getSelectedModuleValue() {
            return localStorage.getItem("selectedModule")
        },

        // get selected track
        getSelectedBusinessValue() {
            return localStorage.getItem("selectedBusiness")
        },

        ellipsis(text, size = 30) {
            if (text.length <= size) {
                return text;
            }
            return text.substr(0, size) + '\u2026'
        },
        setTypeFormat(value){
            return value.replaceAll("_"," ");
        },
        activeBusinessSideBarMenu (value) {
            let path = value.uri.split('/')
            let blockRoutes = ['colors', 'sizes', 'coupons', 'manufacturers'];
            if(path.indexOf('orders') > -1) {
                let blockOrders = ['orders']
                return !blockOrders.includes(path[6]);
            } else {
                return !blockRoutes.includes(path[3]);
            }
        },
        getStatusForTable(status){
            switch(status){
                case 'active':
                    return 'badge--success'
                case 'inactive':
                    return 'badge--danger'
                default :
                    return 'badge--warning'
                    
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

        orderStatus(data, order) {
            let statusArr = []
            data.forEach((value, index) => {
                switch (order.order_status.status) {
                    case 'pending':
                        if(value.status == "pending") {
                            statusArr.push(value)
                        }
                        if(value.status == "accepted") {
                            statusArr.push(value)
                        }
                        if(value.status == "rejected") {
                            statusArr.push(value)
                        }
                        break;
                    case 'accepted':
                        if(value.status == "accepted") {
                            statusArr.push(value)
                        }
                        if(value.status == "completed") {
                            statusArr.push(value)
                        }
                        if(value.status == "refunded" && order.payment_intent_id ) {
                            statusArr.push(value)
                        }
                        if(order.order_type == 'pick_up' && value.status == "ready_for_collection") {
                            statusArr.push(value)
                        }
                        if(order.order_type == 'delivery' && value.status == "ready_for_delivery") {
                            statusArr.push(value)
                        }
                        break;
                    case 'completed':
                        if(value.status == "completed") {
                            statusArr.push(value)
                        }
                        if(value.status == "refunded") {
                            statusArr.push(value)
                        }
                        break;
                    case 'Processing':
                        if(value.status == "Processing") {
                            statusArr.push(value)
                        }
                        break;
                    case 'ready_for_collection':
                        if(value.status == "ready_for_collection") {
                            statusArr.push(value)
                        }
                        if(value.status == "completed") {
                            statusArr.push(value)
                        }
                        if(value.status == "refunded") {
                            statusArr.push(value)
                        }
                        break;
                    case 'ready_for_delivery':
                        if(value.status == "ready_for_delivery") {
                            statusArr.push(value)
                        }
                        if(value.status == "completed") {
                            statusArr.push(value)
                        }
                        if(value.status == "refunded") {
                            statusArr.push(value)
                        }
                        if(order.order_type == 'delivery' && value.status == "delivery_failed") {
                            statusArr.push(value)
                        }
                        break;
                    case 'out_for_delivery':
                        if(value.status == "out_for_delivery") {
                            statusArr.push(value)
                        }
                        if(value.status == "completed") {
                            statusArr.push(value)
                        }
                        if(value.status == "refunded") {
                            statusArr.push(value)
                        }
                        if(order.order_type == 'delivery' && value.status == "delivery_failed") {
                            statusArr.push(value)
                        }
                        break;
                    case 'delivery_failed':
                        if(value.status == "delivery_failed") {
                            statusArr.push(value)
                        }
                        if(value.status == "ready_for_delivery") {
                            statusArr.push(value)
                        }
                        if(value.status == "refunded") {
                            statusArr.push(value)
                        }
                        if(value.status == "rejected") {
                            statusArr.push(value)
                        }
                        break;
                    case 'partially_refunded':
                        if(value.status == "partially_refunded") {
                            statusArr.push(value)
                        }
                        break;
                    case 'refund_failed':
                        if(value.status == "refund_failed") {
                            statusArr.push(value)
                        }
                        break;
                    default:
                        break;
                }
            });
            return statusArr
        },

        orderStatusFilter(data, order_type) {
            let statusArr = []
            data.forEach((value, index) => {
                if(value.id == 1 || value.id == 2) {
                    statusArr.push(value)
                }
                if(order_type == 'pick_up') {
                    if(value.id == 3) {
                        statusArr.push(value)
                    }
                }
                if(order_type == 'delivery') {
                    if(value.id == 4 || value.id == 5) {
                        statusArr.push(value)
                    }
                }
            });
            return statusArr
        },

        orderTotal(orders, decimalLength, decimalSeparator) {
            var total = 0
            orders.data.forEach((value, index) => {
                total += value.total
            })
            return total.toFixed(decimalLength.value)
        }
    }
}