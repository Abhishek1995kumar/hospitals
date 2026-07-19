import { Link, router, usePage } from "@inertiajs/react";
import route from 'ziggy-js';


export default function Sidebar() {
    const { route, usePage } = () => {
        
    }

    return (
        <div id="kt_aside" className="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
            <div className="aside-menu flex-column-fluid">
                <div className="hover-scroll-overlay-y my-5 px-2" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
                    <div className="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                        {/* Dashboard */}
                        <a href="{route('dashboard')}" className="menu-item menu-accordion">
                            <span className="menu-link {{Request::is('admin/dashboard*') ? 'active' : ''}}">
                                <span className="menu-icon">
                                    <span className="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                                <span className="menu-title">Dashboard</span>
                            </span>
                        </a>
                        
                        {/* Hospital Master */}
                            <div className="menu-item pt-5">
                                <div className="menu-content">
                                    <span className="menu-heading fw-bold text-uppercase fs-7">Hospital Management</span>
                                </div>
                            </div>

                            <div data-kt-menu-trigger="click" className="menu-item  menu-accordion">
                                <span className="menu-link">
                                    <span className="menu-icon">
                                        <span className="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span className="menu-title">Machine</span>
                                    <span className="menu-arrow"></span>
                                </span>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Machine Master</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Validate Mobile No Master</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Machine SMS</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">QR BIN</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {/* Hospital Master End */}

                        {/* Clinic Master */}
                            <div className="menu-item pt-5">
                                <div className="menu-content">
                                    <span className="menu-heading fw-bold text-uppercase fs-7">Clinic Management</span>
                                </div>
                            </div>

                            <div data-kt-menu-trigger="click" className="menu-item  menu-accordion">
                                <span className="menu-link">
                                    <span className="menu-icon">
                                        <span className="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span className="menu-title">Clinic</span>
                                    <span className="menu-arrow"></span>
                                </span>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Multiple Clinic Setup</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Clinic Timings</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Doctor Assignment</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {/* Clinic Master End */}

                        {/* <!-- Doctor Management --> */}
                            <div className="menu-item pt-5">
                                <div className="menu-content">
                                    <span className="menu-heading fw-bold text-uppercase fs-7">Doctor Management</span>
                                </div>
                            </div>
                            
                            <div data-kt-menu-trigger="click" className="menu-item  menu-accordion">
                                <span className="menu-link">
                                    <span className="menu-icon">
                                        <span className="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span className="menu-title">Doctor</span>
                                    <span className="menu-arrow"></span>
                                </span>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Registration</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Profile</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Schedule</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Consultation</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">E-Prescription</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {/* <!-- Doctor Management End --> */}

                        {/* <!-- Patient Management --> */}
                            <div className="menu-item pt-5">
                                <div className="menu-content">
                                    <span className="menu-heading fw-bold text-uppercase fs-7">Patient Management</span>
                                </div>
                            </div>

                            <div data-kt-menu-trigger="click" className="menu-item  menu-accordion">
                                <span className="menu-link">
                                    <span className="menu-icon">
                                        <span className="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span className="menu-title">Patient</span>
                                    <span className="menu-arrow"></span>
                                </span>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Registration</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Profile</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {/* <!-- Patient Management End --> */}

                        {/* <!-- OPD Management --> */}
                            <div className="menu-item pt-5">
                                <div className="menu-content">
                                    <span className="menu-heading fw-bold text-uppercase fs-7">OPD Management</span>
                                </div>
                            </div>

                            <div data-kt-menu-trigger="click" className="menu-item  menu-accordion">
                                <span className="menu-link">
                                    <span className="menu-icon">
                                        <span className="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span className="menu-title">OPD System</span>
                                    <span className="menu-arrow"></span>
                                </span>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Registration</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">OPD Ticket</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {/* <!-- OPD Management End --> */}

                        {/* <!-- IPD Management --> */}
                            <div className="menu-item pt-5">
                                <div className="menu-content">
                                    <span className="menu-heading fw-bold text-uppercase fs-7">IPD Management</span>
                                </div>
                            </div>

                            <div data-kt-menu-trigger="click" className="menu-item  menu-accordion">
                                <span className="menu-link">
                                    <span className="menu-icon">
                                        <span className="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span className="menu-title">IPD System</span>
                                    <span className="menu-arrow"></span>
                                </span>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Admission</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Bed Management</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Nursing</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Discharge</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {/* <!-- IPD Management End --> */}

                        {/* <!-- Laboratory Management --> */}
                            <div className="menu-item pt-5">
                                <div className="menu-content">
                                    <span className="menu-heading fw-bold text-uppercase fs-7">Laboratory Management</span>
                                </div>
                            </div>

                            <div data-kt-menu-trigger="click" className="menu-item  menu-accordion">
                                <span className="menu-link">
                                    <span className="menu-icon">
                                        <span className="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span className="menu-title">Laboratory</span>
                                    <span className="menu-arrow"></span>
                                </span>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Pathology</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Cardiology</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Radiology</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Sonography</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">MRI</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Mammography</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">X-Ray</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">CT Scan</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Reports</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {/* <!-- Laboratory Management End --> */}

                        {/* <!-- Pharmacy Management --> */}
                            <div className="menu-item pt-5">
                                <div className="menu-content">
                                    <span className="menu-heading fw-bold text-uppercase fs-7">Pharmacy Management</span>
                                </div>
                            </div>

                            <div data-kt-menu-trigger="click" className="menu-item  menu-accordion">
                                <span className="menu-link">
                                    <span className="menu-icon">
                                        <span className="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span className="menu-title">Pharmacy</span>
                                    <span className="menu-arrow"></span>
                                </span>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Medicine</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Inventory</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Sales</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Purchase</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Reports</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {/* <!-- Pharmacy Management End --> */}

                        {/* <!-- Billing & Accounting Management --> */}
                            <div className="menu-item pt-5">
                                <div className="menu-content">
                                    <span className="menu-heading fw-bold text-uppercase fs-7">Billing Management</span>
                                </div>
                            </div>

                            <div data-kt-menu-trigger="click" className="menu-item  menu-accordion">
                                <span className="menu-link">
                                    <span className="menu-icon">
                                        <span className="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span className="menu-title">Billing</span>
                                    <span className="menu-arrow"></span>
                                </span>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Billing Types</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Payment Methods</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Invoice Features</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {/* <!-- Billing & Accounting Management End --> */}

                        {/* <!-- Payroll Management --> */}
                            <div className="menu-item pt-5">
                                <div className="menu-content">
                                    <span className="menu-heading fw-bold text-uppercase fs-7">Payroll Management</span>
                                </div>
                            </div>

                            <div data-kt-menu-trigger="click" className="menu-item  menu-accordion">
                                <span className="menu-link">
                                    <span className="menu-icon">
                                        <span className="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span className="menu-title">Payroll</span>
                                    <span className="menu-arrow"></span>
                                </span>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Calender</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Attendance</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Leaves</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Shifts</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Ticket Raise</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Meeting</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Run Payslip</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {/* <!-- Payroll Management End --> */}

                        {/* <!-- Emergency Management --> */}
                            <div className="menu-item pt-5">
                                <div className="menu-content">
                                    <span className="menu-heading fw-bold text-uppercase fs-7">Emergency Management</span>
                                </div>
                            </div>

                            <div data-kt-menu-trigger="click" className="menu-item  menu-accordion">
                                <span className="menu-link">
                                    <span className="menu-icon">
                                        <span className="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span className="menu-title">Emergency</span>
                                    <span className="menu-arrow"></span>
                                </span>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Registration</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Ambulance</span>
                                        </a>
                                    </div>
                                </div>
                                <div className="menu-sub menu-sub-accordion">
                                    <div className="menu-item">
                                        <a className="menu-link " href="#">
                                            <span className="menu-bullet">
                                                <span className="bullet bullet-dot"></span>
                                            </span>
                                            <span className="menu-title">Critical Care</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {/* <!-- Emergency Management End --> */}

                        {/* <!-- System Settings --> */}
                            <div className="menu-item pt-5">
                                <div className="menu-content">
                                    <span className="menu-heading fw-bold text-uppercase fs-7">System Settings</span>
                                </div>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link  {{Request::is('admin/customer*') ? 'active' : ''}}" href="{route('customer')}">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">Customers</span>
                                </a>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link " href="#">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">Hospitals</span>
                                </a>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link " href="#">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">Clinics</span>
                                </a>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link " href="#">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">Firm Location</span>
                                </a>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link " href="#">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">Profile</span>
                                </a>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link {{Request::is('admin/permission*') ? 'active' : ''}}" href="{route('permission')}">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">Permission</span>
                                </a>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link " href="#">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">Department</span>
                                </a>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link " href="#">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">Email SMTP</span>
                                </a>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link " href="#">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">SMS API</span>
                                </a>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link " href="#">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">WhatsApp API</span>
                                </a>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link " href="#">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">Tax Settings</span>
                                </a>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link " href="#">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">Payment Gateway</span>
                                </a>
                            </div>
                            
                            <div className="menu-item">
                                <a className="menu-link " href="#">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">Invoice Settings</span>
                                </a>
                            </div>

                            <div className="menu-item">
                                <a className="menu-link " href="#">
                                    <span className="menu-bullet">
                                        <span className="bullet bullet-dot"></span>
                                    </span>
                                    <span className="menu-title">Subscription & Plan</span>
                                </a>
                            </div>
                        {/* <!-- System Settings End --> */}
                    </div>
                </div>
            </div>
        </div>
    );
}