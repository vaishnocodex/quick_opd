<style>
    @font-face {
        font-family: 'Lato';
        font-style: italic;
        font-weight: 400;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/slatov24s6u8w4bmutphjxsaui-qnixg7eu0.woff2) format('woff2');
        unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }

    @font-face {
        font-family: 'Lato';
        font-style: italic;
        font-weight: 400;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/slatov24s6u8w4bmutphjxsaxc-qnixg7q.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    @font-face {
        font-family: 'Lato';
        font-style: italic;
        font-weight: 700;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/slatov24s6u-w4bmutphjxsi5wq-fqftx9897sxz.woff2) format('woff2');
        unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }

    @font-face {
        font-family: 'Lato';
        font-style: italic;
        font-weight: 700;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/slatov24s6u-w4bmutphjxsi5wq-gwftx9897g.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    @font-face {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/slatov24s6uyw4bmutphjxawxiwtfcfq7a.woff2) format('woff2');
        unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }

    @font-face {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/slatov24s6uyw4bmutphjx4wxiwtfcc.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    @font-face {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/slatov24s6u9w4bmutphh6uvswapgq3q5d0n7w.woff2) format('woff2');
        unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }

    @font-face {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/slatov24s6u9w4bmutphh6uvswipgq3q5d0.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/squicksandv366xktdszam9ie8kbpra-hjfqnyudyp7bh.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
    }

    @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/squicksandv366xktdszam9ie8kbpra-hjvqnyudyp7bh.woff2) format('woff2');
        unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }

    @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/squicksandv366xktdszam9ie8kbpra-hk1qnyudypw.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/squicksandv366xktdszam9ie8kbpra-hjfqnyudyp7bh.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
    }

    @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/squicksandv366xktdszam9ie8kbpra-hjvqnyudyp7bh.woff2) format('woff2');
        unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }

    @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/squicksandv366xktdszam9ie8kbpra-hk1qnyudypw.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 600;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/squicksandv366xktdszam9ie8kbpra-hjfqnyudyp7bh.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
    }

    @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 600;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/squicksandv366xktdszam9ie8kbpra-hjvqnyudyp7bh.woff2) format('woff2');
        unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }

    @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 600;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/squicksandv366xktdszam9ie8kbpra-hk1qnyudypw.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/squicksandv366xktdszam9ie8kbpra-hjfqnyudyp7bh.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
    }

    @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/squicksandv366xktdszam9ie8kbpra-hjvqnyudyp7bh.woff2) format('woff2');
        unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }

    @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url({{ asset('website') }}/assets/storage/fonts/10155ba347/squicksandv366xktdszam9ie8kbpra-hk1qnyudypw.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }
</style>

<style>
    :root {
        --font-text: Lato, sans-serif;
        --font-heading: Quicksand, sans-serif;
        --color-brand: #3BB77E;
        --primary-color: #3BB77E;
        --color-brand-rgb: 59, 183, 126;
        --color-brand-dark: #29A56C;
        --color-brand-2: #FDC040;
        --color-primary: #5a97fa;
        --color-secondary: #3e5379;
        --color-warning: #ff9900;
        --color-danger: #FD6E6E;
        --color-success: #81B13D;
        --color-info: #2cc1d8;
        --color-text: #4c4c4c;
        --color-heading: #253D4E;
        --color-grey-1: #253D4E;
        --color-grey-2: #242424;
        --color-grey-4: #adadad;
        --color-grey-9: #f4f5f9;
        --color-muted: #B6B6B6;
        --color-body: #7E7E7E;
        --heading-font-size: 32px;
        --body-font-size: 16px;
    }
</style>

