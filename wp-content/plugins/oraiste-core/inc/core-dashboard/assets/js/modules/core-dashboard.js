(function ( $ ) {
    'use strict';

    $( document ).ready(
        function () {
            qodefThemeRegistration.init();
            qodefImport.init();
            qodefThemeSelectDemo();
            qodefInitSwitch();
        }
    );

    var qodefImport = {
        importDemo: '',
        importImages: 0,
        counterStep: 0,
        contentCounter: 0,
        totalPercent: 0,
        contentFlag: false,
        allFlag: false,
        contentFinished: false,
        allFinished: false,
        repeatFiles: [],
        init: function () {
            qodefImport.holder = $( '.qodef-cd-import-form' );

            if ( qodefImport.holder.length ) {
                qodefImport.holder.each(
                    function () {
                        var qodefImportBtn    = $( '#qodef-import-demo-data' ),
                            importAction      = $( '.qodef-cd-import-option' ),
                            importDemoElement = $( '.qodef-import-demo' ),
                            confirmMessage    = qodefImport.holder.data( 'confirm-message' );

                        importAction.on(
                            'change',
                            function ( e ) {
                                qodefImport.populateSinglePage( importAction.val(), $( '.qodef-import-demo' ).val(), false );
                            }
                        );
                        importDemoElement.on(
                            'change',
                            function ( e ) {
                                qodefImport.populateSinglePage( importAction.val(), $( '.qodef-import-demo' ).val(), true );
                            }
                        );
                        qodefImportBtn.on(
                            'click',
                            function ( e ) {
                                e.preventDefault();
                                qodefImport.reset();
                                qodefImport.importImages = $( '.qodef-cd-import-attachments' ).is( ':checked' ) ? 1 : 0;
                                qodefImport.importDemo   = importDemoElement.val();

                                if ( confirm( confirmMessage ) ) {
                                    $( '.qodef-cd-box-form-section-progress' ).show();
                                    $( this ).addClass( 'qodef-import-demo-data-disabled' );
                                    $( this ).attr( 'disabled', true );

                                    qodefImport.initImportType( importAction.val() );
                                }
                            }
                        );
                    }
                );
            }
        },
        initImportType: function ( action ) {
            switch (action) {
                case 'widgets':
                    qodefImport.importWidgets();
                    break;
                case 'options':
                    qodefImport.importOptions();
                    break;
                case 'content':
                    qodefImport.contentFlag = true;
                    qodefImport.importContent();
                    break;
                case 'complete':
                    qodefImport.allFlag = true;
                    qodefImport.importAll();
                    break;
                case 'single-page':
                    qodefImport.importSinglePage();
                    break;
                case 'rev-slider':
                    qodefImport.importRevSlider();
                    break;
            }
        },
        importWidgets: function () {
            var data = {
                action: 'widgets',
                demo: qodefImport.importDemo
            };
            qodefImport.importAjax( data );
        },
        importOptions: function () {
            var data = {
                action: 'options',
                demo: qodefImport.importDemo
            };
            qodefImport.importAjax( data );
        },
        importSettingsPages: function () {
            var data = {
                action: 'settings-page',
                demo: qodefImport.importDemo
            };
            qodefImport.importAjax( data );
        },
        importMenuSettings: function () {
            var data = {
                action: 'menu-settings',
                demo: qodefImport.importDemo
            };
            qodefImport.importAjax( data );
        },
        importRevSlider: function () {
            var data = {
                action: 'rev-slider',
                demo: qodefImport.importDemo
            };
            qodefImport.importAjax( data );
        },
        importContent: function () {
            if ( qodefImport.contentCounter == 0 ) {
                qodefImport.importTerms();
            }
            if ( qodefImport.contentCounter == 1 ) {
                qodefImport.importAttachments();
            }
            if ( (qodefImport.contentCounter > 1 && qodefImport.contentCounter < 20) && qodefImport.repeatFiles.length ) {
                qodefImport.importAttachments( true );
            }
            if ( qodefImport.contentCounter == 20 ) {
                qodefImport.importPosts();
            }
        },
        importAll: function () {

            if ( qodefImport.contentCounter < 21 ) {
                qodefImport.importContent();
            } else {
                qodefImport.contentFinished = true;
            }

            if ( qodefImport.contentFinished && ! qodefImport.allFinished ) {
                qodefImport.importWidgets();
                qodefImport.importOptions();
                qodefImport.importSettingsPages();
                qodefImport.importMenuSettings();
                qodefImport.importRevSlider();
                qodefImport.allFinished = true;
            }
        },
        importTerms: function () {
            var data = {
                action: 'content',
                xml: 'oraiste_content_0.xml',
                contentStart: true
            };
            qodefImport.importAjax( data );
        },
        importPosts: function () {
            var data = {
                action: 'content',
                xml: 'oraiste_content_20.xml',
                updateURL: true
            };
            qodefImport.importAjax( data );
        },
        importSinglePage: function () {
            var postId = $( '#import_single_page' ).val();
            var data   = {
                action: 'content',
                xml: 'oraiste_content_20.xml',
                post_id: postId
            };
            qodefImport.importAjax( data );
        },
        importAttachments: function ( repeat ) {
            if ( qodefImport.repeatFiles.length && repeat ) {
                qodefImport.repeatFiles.forEach(
                    function ( index ) {
                        var data = {
                            action: 'content',
                            xml: index,
                            images: qodefImport.importImages,
                        };

                        qodefImport.importAjax( data );
                    }
                );

                qodefImport.repeatFiles = [];
            }

            if ( ! repeat ) {
                for ( var i = 1; i < 20; i++ ) {
                    var xml  = i < 20 ? 'oraiste_content_' + i + '.xml' : 'oraiste_content_' + i + '.xml';
                    var data = {
                        action: 'content',
                        xml: xml,
                        images: qodefImport.importImages,
                    };

                    qodefImport.importAjax( data );
                }
            }
        },
        importAjax: function ( options ) {
            var defaults = {
                demo: qodefImport.importDemo,
                nonce: $( '#qodef_cd_import_nonce' ).val(),
            };

            $.extend( defaults, options );

            $.ajax(
                {
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'import_action',
                        options: defaults,
                    },
                    success: function ( data ) {
                        var response = JSON.parse( data );

                        qodefImport.ajaxSuccess( response );
                    },
                    error: function ( data ) {
                        var response = JSON.parse( data );

                        qodefImport.ajaxError( response, options );
                    },
                }
            );
        },
        importProgress: function () {
            if ( ! qodefImport.contentFlag && ! qodefImport.allFlag ) {
                qodefImport.totalPercent = 100;
            } else if ( qodefImport.contentFlag ) {
                if ( qodefImport.contentCounter < 21 ) {
                    qodefImport.totalPercent += 4.5;
                } else if ( qodefImport.contentCounter == 21 ) {
                    qodefImport.totalPercent += 10;
                }
            } else if ( qodefImport.allFlag ) {
                if ( qodefImport.contentCounter < 21 ) {
                    qodefImport.totalPercent += 4;
                } else if ( qodefImport.contentCounter == 21 ) {
                    qodefImport.totalPercent += 10;
                } else {
                    qodefImport.totalPercent += 2;
                }
            }

            $( '#qodef-progress-bar' ).val( qodefImport.totalPercent );
            $( '.qodef-cd-progress-percent' ).html( Math.round( qodefImport.totalPercent ) + '%' );

            if ( qodefImport.totalPercent == 100 ) {
                $( '#qodef-import-demo-data' ).remove( '.qodef-import-demo-data-disabled' );
                $( '.qodef-cd-import-is-completed' ).show();
            }
        },
        ajaxSuccess: function ( response ) {
            if ( typeof response.status !== 'undefined' && response.status == 'success' ) {
                if ( qodefImport.contentFlag ) {
                    qodefImport.contentCounter++;
                    qodefImport.importContent();
                }
                if ( qodefImport.allFlag ) {
                    qodefImport.contentCounter++;
                    qodefImport.importAll();
                }
                qodefImport.importProgress();
            } else {

                if ( typeof response.data.type !== 'undefined' && response.data.type == 'content' ) {
                    qodefImport.repeatFiles.push( response.data['xml'] );
                } else if ( typeof response.data.type !== 'undefined' && response.data.type == 'options' ) {
                    qodefImport.holder.find( '.qodef-cd-import-went-wrong' ).remove();
                    $( '#qodef-import-demo-data' ).remove( '.qodef-import-demo-data-disabled' );

                    qodefImport.holder.find( '.qodef-cd-box-form-last-section' ).append( '<span class="qodef-cd-import-went-wrong">' + response.message + '</span>' );
                }
            }
        },
        ajaxError: function ( response, options ) {
            if ( 'xml' in options ) {
                if ( qodefImport.contentFlag ) {
                    qodefImport.importContent();
                }
                if ( qodefImport.allFlag ) {
                    qodefImport.importAll();
                }
                qodefImport.repeatFiles.push( options.xml );

            }
        },
        reset: function () {
            qodefImport.totalPercent = 0;
            $( '#qodef-progress-bar' ).val( 0 );
        },
        populateSinglePage: function ( value, demo, demoChange ) {
            var holder  = $( '.qodef-cd-box-form-section-dependency' ),
                options = {
                    demo: demo,
                    nonce: $( '#qodef_cd_import_nonce' ).val(),
                };

            if ( value == 'single-page' ) {
                if ( holder.children().length == 0 || demoChange ) {

                    $.ajax(
                        {
                            type: 'POST',
                            url: ajaxurl,
                            data: {
                                action: 'populate_single_pages',
                                options: options,
                            },
                            success: function ( data ) {
                                var response = $.parseJSON( data );

                                if ( response.status == 'success' ) {
                                    $( '.qodef-cd-box-form-section-dependency' ).html( response.data );
                                    var singlePageList = $( 'select.qodef-cd-import-single-page' );
                                    holder.show();

                                    singlePageList.select2(
                                        {
                                            dropdownCssClass: 'qodef-cd-single-page-selection',
                                        }
                                    );
                                } else {
                                    holder.html( response.message );
                                    holder.show();
                                }
                            },
                        }
                    );
                } else {
                    holder.show();
                }

            } else {
                holder.hide();
            }
        },
    };

    var qodefThemeRegistration = {
        init: function () {
            qodefThemeRegistration.holder = $( '#qode-register-purchase-form' );

            if ( qodefThemeRegistration.holder.length ) {
                qodefThemeRegistration.holder.each(
                    function () {
                        var form = $( this );

                        var qodefRegistrationBtn   = $( this ).find( '#qode-register-purchase-key' ),
                            qodefdeRegistrationBtn = $( this ).find( '#qode-deregister-purchase-key' );

                        qodefRegistrationBtn.on(
                            'click',
                            function ( e ) {
                                e.preventDefault();

                                var $button = $( this );

                                $button.addClass( 'qodef-cd-button-disabled' );
                                $button.attr( 'disabled', true );
                                $button.siblings( '.qodef-cd-button-wait' ).show();

                                if ( qodefThemeRegistration.validateFields( form ) ) {
                                    var post = form.serialize();
                                    qodefThemeRegistration.registration( post );
                                } else {
                                    $button.removeClass( 'qodef-cd-button-disabled' );
                                    $button.attr( 'disabled', false );
                                    $button.siblings( '.qodef-cd-button-wait' ).hide();
                                }
                            }
                        );

                        qodefdeRegistrationBtn.on(
                            'click',
                            function ( e ) {
                                e.preventDefault();

                                var $button = $( this );

                                $button.addClass( 'qodef-cd-button-disabled' );
                                $button.attr( 'disabled', true );
                                $button.siblings( '.qodef-cd-button-wait' ).show();

                                qodefThemeRegistration.deregistration();
                            }
                        );
                    }
                );
            }
        },
        registration: function ( post ) {
            var data = {
                action: 'register',
                post: post,
            };

            qodefThemeRegistration.registrationAjax( data );
        },
        deregistration: function () {
            var data = {
                action: 'deregister',
            };

            qodefThemeRegistration.registrationAjax( data );
        },
        validateFields: function ( form ) {
            if ( qodefThemeRegistration.validatePurchaseCode( form ) && qodefThemeRegistration.validateEmail( form ) ) {
                return true;
            }
        },
        validateEmail: function ( form ) {
            var email = form.find( '[name=\'email\']' );
            var emailVal = email.val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if ( emailVal !== '' && regex.test( emailVal ) ) {
                email.removeClass( 'qodef-cd-error-field' );
                email.parent().find( '.qodef-cd-error-message' ).remove();
                return true;
            } else if ( emailVal == '' ) {
                email.addClass( 'qodef-cd-error-field' );
                qodefThemeRegistration.errorMessage( email.parent().data( 'empty-field' ), email.parent() );
            } else if ( ! regex.test( emailVal ) ) {
                email.addClass( 'qodef-cd-error-field' );
                qodefThemeRegistration.errorMessage( email.parent().data( 'invalid-field' ), email.parent() );
            }
        },
        validatePurchaseCode: function ( form ) {
            var purchaseCode = form.find( '[name=\'purchase_code\']' );
            var purchaseCodeVal = purchaseCode.val();

            if ( purchaseCodeVal !== '' ) {
                purchaseCode.removeClass( 'qodef-cd-error-field' );
                purchaseCode.parent().find( '.qodef-cd-error-message' ).remove();
                return true;
            } else {
                qodefThemeRegistration.errorMessage( purchaseCode.parent().data( 'empty-field' ), purchaseCode.parent() );
                purchaseCode.addClass( 'qodef-cd-error-field' );
            }
        },
        errorMessage: function ( message, target ) {
            target.find( '.qodef-cd-error-message' ).remove();
            $( '<span class="qodef-cd-error-message"></span>' ).text( message ).appendTo( target );
        },
        registrationAjax: function ( options ) {
            $.ajax(
                {
                    type: 'POST',
                    url: qodefCoreDashboardGlobalVars.vars.restUrl + qodefCoreDashboardGlobalVars.vars.registrationThemeRoute,
                    data: {
                        options: options,
                    },
                    beforeSend: function ( request ) {
                        request.setRequestHeader( 'X-WP-Nonce', qodefCoreDashboardGlobalVars.vars.restNonce );
                    },
                    success: function ( response ) {
                        if ( response.status == 'success' ) {
                            location.reload();
                        } else if ( response.status == 'error' && ((typeof response.data['purchase_code'] !== 'undefined' && response.data['purchase_code'] === false) || (typeof response.data['already_used'] !== 'undefined' && response.data['already_used'] === true)) ) {
                            qodefThemeRegistration.errorMessage( response.message, $( '[name=\'purchase_code\']' ).parent() );
                            $( '#qode-register-purchase-key' ).removeClass( 'qodef-cd-button-disabled' );
                            $( '#qode-register-purchase-key' ).attr( 'disabled', false );
                            $( '#qode-register-purchase-key' ).siblings( '.qodef-cd-button-wait' ).hide();
                        } else if ( response.status == 'error' ) {
                            alert( response.message );
                        }
                    },
                    error: function ( response ) {
                        console.log( response );
                    },
                }
            );
        }
    };

    function qodefThemeSelectStyles( selection ) {
        if ( ! selection.id ) {
            return selection.text;
        }

        var thumb = $( selection.element ).data( 'thumb' );
        if ( ! thumb ) {
            return selection.text;
        } else {
            var $selection = $(
                '<img src="' + thumb + '" alt="Demo Thumbnail"><span class="img-changer-text">' + $( selection.element ).text() + '</span>'
            );
            return $selection;
        }
    }

    function qodefThemeSelectDemo() {
        var themeList = $( 'select.qodef-import-demo' );

        themeList.select2(
            {
                templateResult: qodefThemeSelectStyles,
                minimumResultsForSearch: -1,
                dropdownCssClass: 'qodef-cd-selection',
            }
        );

        var optionList = $( 'select.qodef-cd-import-option' );
        optionList.select2(
            {
                minimumResultsForSearch: -1,
                dropdownCssClass: 'qodef-cd-action-selection',
            }
        );
    }

    function qodefInitSwitch() {
        $( '.qodef-cd-cb-enable' ).on(
            'click',
            function () {
                var parent = $( this ).parents( '.qodef-cd-switch' );

                $( '.qodef-cd-cb-disable', parent ).removeClass( 'selected' );
                $( this ).addClass( 'selected' );
                $( '.qodef-cd-import-attachments', parent ).attr( 'checked', true );
            }
        );

        $( '.qodef-cd-cb-disable' ).on(
            'click',
            function () {
                var parent = $( this ).parents( '.qodef-cd-switch' );

                $( '.qodef-cd-cb-enable', parent ).removeClass( 'selected' );
                $( this ).addClass( 'selected' );
                $( '.qodef-cd-import-attachments', parent ).attr( 'checked', false );
            }
        );
    }

})( jQuery );
