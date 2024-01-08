import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

export function useToastr() {

    toastr.options = {
        positionClass: 'toast-top-right',
        progressBar: true,
        showDuration: 300,
        closeButton: true,
    }
    return toastr;
}