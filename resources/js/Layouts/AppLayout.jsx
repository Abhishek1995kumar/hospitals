import Footer from "../Components/Footer";
import Header from "../Components/Header";
import Loader from "../Components/Loader";
import Sidebar from "../Components/Sidebar";


export default function AppLayout({ children }) {
    return (
        <div className="d-flex flex-column flex-root">
            <Loader />
            <div className="page d-flex flex-row flex-column-fluid">
                <Sidebar />
                <div className="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    <Header />
                    <div className="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <div className="post d-flex flex-column-fluid" id="kt_post">
                            <div id="kt_content_container" className="container-xxl">
                                { children }
                            </div>
                        </div>
                    </div>
                    <Footer />
                </div>
            </div>
        </div>
    );
}


