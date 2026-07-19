import { useEffect, useState } from "react";
import { usePage } from '@inertiajs/react';

export default function Footer() {
    const { appName } = usePage().props;
    const [date, setDate] = useState(new Date);
    let dateValue = date.getFullYear();
    return (
        <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
            <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                <div class="text-dark order-2 order-md-1">
                    <span class="text-muted fw-semibold me-1"> {dateValue} &copy;</span>
                    {/* <a href="" target="_blank" class="text-gray-800 text-hover-primary">स्वागत है {appName} में!</a> */}
                    <a href="" target="_blank" class="text-gray-800 text-hover-primary"> {appName} </a>
                </div>
            </div>
        </div>
    );
}