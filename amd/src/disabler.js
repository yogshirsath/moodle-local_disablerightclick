// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Javascript controller for the "Actions" panel at the bottom of the page.
 *
 * @module     local_disablerightclick/disabler
 * @package    local_disablerightclick
 * @copyright  2019 Yogesh Shirsath <yogshirsath@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      1.0
 */

define(['jquery', 'core/ajax', 'core/notification'], function($, Ajax, Notification) {
    return {
        init: function() {
            var devtools = {
                isOpen: false,
                orientation: undefined
            };

            // Threshold to check developer tools change.
            var threshold = 160;

            // Store strings.
            var strings = [];

            // Store whole body.
            var wholebody = null;

            // Store whole head.
            var wholehead = null;

            /**
             * Show toaster with message
             *
             * @param {String}  msg      Toaster message
             * @param {Integer} duration Duration of toaster
             */
            function showToaster(msg, duration) {
                if (duration == undefined) {
                    duration = 2000;
                }
                var toast = $("<div class='disabler-toaster toaster-container'>" +
                "<lable class='toaster-message'>" + msg + "</lable>" +
                "</div>");
                $('html').append(toast);
                $(toast).addClass('show');
                setTimeout(function() {
                    $(toast).addClass('fade');
                    setTimeout(function() {
                        $(toast).removeClass('fade');
                        setTimeout(function() {
                            $(toast).remove();
                        }, 300);
                    }, duration);
                });
            }

            /**
             * Start interval when developer tools is opened else clear inerval
             *
             * @param  {Boolean} isOpen true if tools is open
             */
            function devToolsToggled(isOpen) {
                if (isOpen == true) {
                    // eslint-disable-next-line no-console
                    console.clear();
                    wholebody = $('body').detach();
                    if ($('head')) {
                        wholehead = $('head').detach();
                    }
                    if ($('#body-detached-css').length == 0) {
                        $('html').append(
                            $('<style id="body-detached-css">' +
                            '.disabler-toaster.toaster-container {' +
                            'position: fixed;' +
                            'width: 100%;' +
                            'top: 1vw;' +
                            'z-index: 140002;' +
                            'left: 0;' +
                            'opacity: 0;' +
                            'text-align: center;' +
                            'transition: top 0.3s linear, opacity 0.3s linear;' +
                            'display: none;' +
                            '}' +
                            '.disabler-toaster.toaster-container.fade {' +
                            'top: 6vw;' +
                            'opacity: 1;' +
                            '}' +
                            '.disabler-toaster.toaster-container.show {' +
                            'display: block;' +
                            '}' +
                            '.disabler-toaster.toaster-container .toaster-message {' +
                            'padding: 1rem 2rem;' +
                            'color: white;' +
                            'border-radius: 2px;' +
                            'background-color: #424242;' +
                            '}' +
                            '</style>')
                        );
                    }
                    showToaster(strings.developertoolsopened, 5000);
                }
                if (isOpen == false) {
                    $('html').append(wholebody);
                    wholebody = null;
                    if (wholehead !== null) {
                        $('html').append(wholehead);
                    }
                }
            }

            /**
             * Check whether developer tools are opened or not
             */
            function checkDevTools() {

                // Check key down.
                $('body').on('keydown', function(event) {
                    if (event.keyCode == 123 ||
                        (event.ctrlKey == true && event.shiftKey == true && [67, 73, 74].indexOf(event.keyCode) != -1) ||
                        (event.ctrlKey == true && [85].indexOf(event.keyCode) != -1)) {
                        showToaster(strings.developertools);
                        event.preventDefault();
                        return;
                    }
                });

                // Start interval to check developer tools is open or close.
                setInterval(function() {
                    var widthThreshold = window.outerWidth - window.innerWidth > threshold;
                    var heightThreshold = window.outerHeight - window.innerHeight > threshold;
                    var orientation = widthThreshold ? 'vertical' : 'horizontal';

                    if (
                        !(heightThreshold && widthThreshold) &&
                        ((window.Firebug && window.Firebug.chrome && window.Firebug.chrome.isInitialized) ||
                            widthThreshold ||
                            heightThreshold)
                    ) {
                        if (!devtools.isOpen || devtools.orientation !== orientation) {
                            devToolsToggled(true);
                        }

                        devtools.isOpen = true;
                        devtools.orientation = orientation;
                    } else {
                        if (devtools.isOpen) {
                            devToolsToggled(false);
                        }

                        devtools.isOpen = false;
                        devtools.orientation = undefined;
                    }
                }, 1000);
            }

            /**
             * Check if current page has url from allowed list
             *
             * @param  {String} currentUrl Current page url
             * @param  {String} allowed    Allowed url list
             * @return {Bool}              True if allowed on current page
             */
            function currentPage(currentUrl, allowed) {
                var matched = false;
                allowed = allowed.trim().split('\n');
                allowed.forEach(function(url) {
                    if (matched) {
                        return;
                    }
                    if (currentUrl.indexOf(url.trim()) != -1) {
                        matched = true;
                    }
                });
                return matched;
            }

            /**
             * Disable functionality based on admin settings
             *
             * @param {Object} settings Settings object
             */
            function disabler(settings) {

                // Skip if no need to disable
                if (settings.length == 0) {
                    return;
                }

                // Current page url
                var url = window.location.href;

                // Skip disabling if all allowed in current page
                if (settings.allowall != '' && currentPage(url, settings.allowall)) {
                    return;
                }

                // Disable right click.
                if (settings.disablerightclick && settings.disablerightclick == true) {
                    // Skip disabling if allowed in current page
                    if (settings.allowrightclick != '' && currentPage(url, settings.allowrightclick)) {
                        return;
                    }
                    $('body').contextmenu(function(event) {
                        showToaster(strings.rightclick);
                        event.preventDefault();
                        return;
                    });
                }

                // Disable cut copy paste.
                if (settings.disablecutcopypaste && settings.disablecutcopypaste == true) {
                    // Skip disabling if allowed in current page
                    if (settings.allowcutcopypaste != '' && currentPage(url, settings.allowcutcopypaste)) {
                        return;
                    }
                    $('body').on('keydown', function(event) {
                        if (event.ctrlKey == true && [65, 67, 83, 86, 88].indexOf(event.keyCode) != -1) {
                            showToaster(strings.cutcopypaste);
                            event.preventDefault();
                            return;
                        }
                    });
                }

                // Disable developer tools.
                if (settings.disabledevelopertools && settings.disabledevelopertools == true) {
                    // Skip disabling if allowed in current page
                    if (settings.allowdevelopertools != '' && currentPage(url, settings.allowdevelopertools)) {
                        return;
                    }
                    checkDevTools();
                }
            }

            $(document).ready(function() {
                var contextid = 0;
                if (M.cfg.contextid != undefined) {
                    contextid = M.cfg.contextid;
                }
                Ajax.call([{
                    methodname: "local_disablerightclick_settings",
                    args: {
                        contextid: contextid
                    }
                }])[0].done(function(response) {
                    var data = JSON.parse(response);
                    strings = data.strings;
                    disabler(data.settings);
                }).fail(Notification.exception);
            });
        }
    };
});
