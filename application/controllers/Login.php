<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 로그인 페이지와 관련된 controller 입니다.
 */
class Login extends CB_Controller
{

    /**
     * 모델을 로딩합니다
     */
    protected $models = array();

    /**
     * 헬퍼를 로딩합니다
     */
    protected $helpers = array('form', 'array', 'string');

    function __construct()
    {
        parent::__construct();

        $this->load->library(array('querystring', 'email','cmalllib'));
    }


    /**
     * 로그인 페이지입니다
     */
    public function index()
    {
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_login_index';
        $this->load->event($eventname);

        if ($this->member->is_member() !== false && ! ($this->member->is_admin() === 'super' && $this->uri->segment(1) === config_item('uri_segment_admin'))) {
            redirect();
        }

        $view = array();
        $view['view'] = array();
        $param =& $this->querystring;
        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        $this->load->library(array('form_validation'));

         if ( ! function_exists('password_hash')) {
            $this->load->helper('password');
        }

        $use_login_account = $this->cbconfig->item('use_login_account');

        $view['view']['login_url']=site_url('login') . '?' .$param->output();
        $view['view']['findidpw_url']=site_url('login/findidpw') . '?' .$param->output();
        /**
         * 전송된 데이터의 유효성을 체크합니다
         */
        if ($use_login_account === 'both') {
            $config[] = array(
                'field' => 'mem_userid',
                'label' => 'id or email',
                'rules' => 'trim|required',
            );
            $view['view']['userid_label_text'] = 'id or email';
        } elseif ($use_login_account === 'email') {
            $config[] = array(
                'field' => 'mem_userid',
                'label' => 'email',
                'rules' => 'trim|required|valid_email',
            );
            $view['view']['userid_label_text'] = 'email';
        } else {
            $config[] = array(
                'field' => 'mem_userid',
                'label' => 'id',
                'rules' => 'trim|required|alphanumunder|min_length[3]|max_length[20]',
            );
            $view['view']['userid_label_text'] = 'id';
        }
        $config[] = array(
            'field' => 'mem_password',
            'label' => 'password',
            'rules' => 'trim|required|min_length[4]|callback__check_id_pw[' . $this->input->post('mem_userid') . ']',
        );

        $this->form_validation->set_rules($config);
        /**
         * 유효성 검사를 하지 않는 경우, 또는 유효성 검사에 실패한 경우입니다.
         * 즉 글쓰기나 수정 페이지를 보고 있는 경우입니다
         */
        if ($this->form_validation->run() === false) {

            // 이벤트가 존재하면 실행합니다
            $view['view']['event']['formrunfalse'] = Events::trigger('formrunfalse', $eventname);

            if ($this->input->post('returnurl')) {
                if (validation_errors('<div class="alert alert-warning" role="alert">', '</div>')) {
                    $this->session->set_flashdata(
                        'loginvalidationmessage',
                        validation_errors('<div class="alert alert-warning" role="alert">', '</div>')
                    );
                }
                $this->session->set_flashdata(
                    'loginuserid',
                    $this->input->post('mem_userid')
                );
                redirect(urldecode($this->input->post('returnurl')));
            }

            $view['view']['canonical'] = site_url('login');

            // 이벤트가 존재하면 실행합니다
            $view['view']['event']['before_layout'] = Events::trigger('before_layout', $eventname);

            /**
             * 레이아웃을 정의합니다
             */
            $page_title = $this->cbconfig->item('site_meta_title_login');
            $meta_description = $this->cbconfig->item('site_meta_description_login');
            $meta_keywords = $this->cbconfig->item('site_meta_keywords_login');
            $meta_author = $this->cbconfig->item('site_meta_author_login');
            $page_name = $this->cbconfig->item('site_page_name_login');

            $layoutconfig = array(
                'path' => 'login',
                'layout' => 'layout',
                'skin' => 'login',
                'layout_dir' => $this->cbconfig->item('layout_login'),
                'mobile_layout_dir' => $this->cbconfig->item('mobile_layout_login'),
                'use_sidebar' => $this->cbconfig->item('sidebar_login'),
                'use_mobile_sidebar' => $this->cbconfig->item('mobile_sidebar_login'),
                'skin_dir' => $this->cbconfig->item('skin_login'),
                'mobile_skin_dir' => $this->cbconfig->item('mobile_skin_login'),
                'page_title' => $page_title,
                'meta_description' => $meta_description,
                'meta_keywords' => $meta_keywords,
                'meta_author' => $meta_author,
                'page_name' => $page_name,
            );
            $view['layout'] = $this->managelayout->front($layoutconfig, $this->cbconfig->get_device_view_type());
            $this->data = $view;
            $this->layout = element('layout_skin_file', element('layout', $view));
            $this->view = element('view_skin_file', element('layout', $view));
        } else {
            /**
             * 유효성 검사를 통과한 경우입니다.
             * 즉 데이터의 insert 나 update 의 process 처리가 필요한 상황입니다
             */

            // 이벤트가 존재하면 실행합니다
            $view['view']['event']['formruntrue'] = Events::trigger('formruntrue', $eventname);

            if ($use_login_account === 'both') {
                $userinfo = $this->Member_model->get_by_both($this->input->post('mem_userid'), 'mem_id, mem_userid');
            } elseif ($use_login_account === 'email') {
                $userinfo = $this->Member_model->get_by_email($this->input->post('mem_userid'), 'mem_id, mem_userid');
            } else {
                $userinfo = $this->Member_model->get_by_userid($this->input->post('mem_userid'), 'mem_id, mem_userid');
            }
            $this->member->update_login_log(element('mem_id', $userinfo), $this->input->post('mem_userid'), 1, '로그인 성공');
            $this->session->set_userdata(
                'mem_id',
                element('mem_id', $userinfo)
            );

            if ($this->input->post('autologin')) {
                $vericode = array('$', '/', '.');
                $hash = str_replace(
                    $vericode,
                    '',
                    password_hash(random_string('alnum', 10) . element('mem_id', $userinfo) . ctimestamp() . element('mem_userid', $userinfo), PASSWORD_BCRYPT)
                );
                $insertautologin = array(
                    'mem_id' => element('mem_id', $userinfo),
                    'aul_key' => $hash,
                    'aul_ip' => $this->input->ip_address(),
                    'aul_datetime' => cdate('Y-m-d H:i:s'),
                );
                $this->load->model(array('Autologin_model'));
                $this->Autologin_model->insert($insertautologin);

                $cookie_name = 'autologin';
                $cookie_value = $hash;
                $cookie_expire = 2592000; // 30일간 저장
                set_cookie($cookie_name, $cookie_value, $cookie_expire);
            }

            $change_password_date = $this->cbconfig->item('change_password_date');
            $site_title = $this->cbconfig->item('site_title');
            if ($change_password_date) {

                $meta_change_pw_datetime = $this->member->item('meta_change_pw_datetime');
                if ( ctimestamp() - strtotime($meta_change_pw_datetime) > $change_password_date * 86400) {
                    $this->session->set_userdata(
                        'membermodify',
                        '1'
                    );
                    $this->session->set_flashdata(
                        'message',
                        html_escape($site_title) . ' We encourage you to periodically change your password. 
                        <br /> If you are using an old password, we recommend that you change your password to use a secure service.'
                    );
                    redirect('membermodify/password_modify');
                }
            }

            $url_after_login = $this->cbconfig->item('url_after_login');
            if ($url_after_login) {
                $url_after_login = site_url($url_after_login);
            }
            if (empty($url_after_login)) {
                $url_after_login = $this->input->get_post('url') ? urldecode($this->input->get_post('url')) : site_url();
            }


            $return = $this->cmalllib->cart_to_cart(
                element('mem_id', $userinfo),
                $_COOKIE[config_item('sess_cookie_name')]
            );
            // 이벤트가 존재하면 실행합니다
            Events::trigger('after', $eventname);

            redirect($url_after_login);
        }
    }


    /**
     * 로그인시 아이디와 패스워드가 일치하는지 체크합니다
     */
    public function _check_id_pw($password, $userid)
    {
         if ( ! function_exists('password_hash')) {
            $this->load->helper('password');
        }

        $max_login_try_count = (int) $this->cbconfig->item('max_login_try_count');
        $max_login_try_limit_second = (int) $this->cbconfig->item('max_login_try_limit_second');

        $loginfailnum = 0;
        $loginfailmessage = '';
        if ($max_login_try_count && $max_login_try_limit_second) {
            $select = 'mll_id, mll_success, mem_id, mll_ip, mll_datetime';
            $where = array(
                'mll_ip' => $this->input->ip_address(),
                'mll_datetime > ' => strtotime(ctimestamp() - 86400 * 30),
            );
            $this->load->model('Member_login_log_model');
            $logindata = $this->Member_login_log_model
                ->get('', $select, $where, '', '', 'mll_id', 'DESC');

            if ($logindata && is_array($logindata)) {
                foreach ($logindata as $key => $val) {
                    if ((int) $val['mll_success'] === 0) {
                        $loginfailnum++;
                    } elseif ((int) $val['mll_success'] === 1) {
                        break;
                    }
                }
            }
            if ($loginfailnum > 0 && $loginfailnum % $max_login_try_count === 0) {
                $lastlogintrydatetime = $logindata[0]['mll_datetime'];
                $next_login = strtotime($lastlogintrydatetime)
                    + $max_login_try_limit_second
                    - ctimestamp();
                if ($next_login > 0) {
                    $this->form_validation->set_message(
                        '_check_id_pw',
                        'You entered the wrong password ' . $loginfailnum . ' in a row ,so you can try again in '
                        . $next_login . ' second'
                    );
                    return false;
                }
            }
            $loginfailmessage = '<br />You have entered the wrong password ' . ($loginfailnum + 1)
                . ' in a row ';
        }

        $use_login_account = $this->cbconfig->item('use_login_account');

        $this->load->model(array('Member_dormant_model'));

        $userselect = 'mem_id, mem_password, mem_denied, mem_email_cert, mem_is_admin';
        $is_dormant_member = false;
        if ($use_login_account === 'both') {
            $userinfo = $this->Member_model->get_by_both($userid, $userselect);
            if ( ! $userinfo) {
                $userinfo = $this->Member_dormant_model->get_by_both($userid, $userselect);
                if ($userinfo) {
                    $is_dormant_member = true;
                }
            }
        } elseif ($use_login_account === 'email') {
            $userinfo = $this->Member_model->get_by_email($userid, $userselect);
            if ( ! $userinfo) {
                $userinfo = $this->Member_dormant_model->get_by_email($userid, $userselect);
                if ($userinfo) {
                    $is_dormant_member = true;
                }
            }
        } else {
            $userinfo = $this->Member_model->get_by_userid($userid, $userselect);
            if ( ! $userinfo) {
                $userinfo = $this->Member_dormant_model->get_by_userid($userid, $userselect);
                if ($userinfo) {
                    $is_dormant_member = true;
                }
            }
        }
        $hash = password_hash($password, PASSWORD_BCRYPT);

        if ( ! element('mem_id', $userinfo) OR ! element('mem_password', $userinfo)) {
            $this->form_validation->set_message(
                '_check_id_pw',
                'Member ID and password do not match' . $loginfailmessage
            );
            $this->member->update_login_log(0, $userid, 0, 'Member ID does not exist');
            return false;
        } elseif ( ! password_verify($password, element('mem_password', $userinfo))) {
            $this->form_validation->set_message(
                '_check_id_pw',
                'Member ID and password do not match' . $loginfailmessage
            );
            $this->member->update_login_log(element('mem_id', $userinfo), $userid, 0, 'The password is incorrect');
            return false;
        } elseif (element('mem_denied', $userinfo)) {
            $this->form_validation->set_message(
                '_check_id_pw',
                '회원님의 아이디는 접근이 금지된 아이디입니다'
            );
            $this->member->update_login_log(element('mem_id', $userinfo), $userid, 0, '접근이 금지된 아이디입니다');
            return false;
        } elseif ($this->cbconfig->item('use_register_email_auth') && ! element('mem_email_cert', $userinfo)) {
            $this->form_validation->set_message(
                '_check_id_pw',
                '회원님은 아직 이메일 인증을 받지 않으셨습니다'
            );
            $this->member->update_login_log(element('mem_id', $userinfo), $userid, 0, '이메일 인증을 받지 않은 회원아이디입니다');
            return false;
        } elseif (element('mem_is_admin', $userinfo) && $this->input->post('autologin')) {
            $this->form_validation->set_message(
                '_check_id_pw',
                '최고관리자는 자동로그인 기능을 사용할 수 없습니다'
            );
            return false;
        }

        if ($is_dormant_member === true) {
            $this->member->recover_from_dormant(element('mem_id', $userinfo));
        }

        return true;
    }


    /**
     * 로그아웃합니다
     */
    public function logout()
    {
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_logout_index';
        $this->load->event($eventname);

        // 이벤트가 존재하면 실행합니다
        Events::trigger('before', $eventname);

        if ($this->member->is_member() === false) {
            redirect();
        }

        $where = array(
            'mem_id' => $this->member->item('mem_id'),
        );
        $this->load->model(array('Autologin_model'));
        $this->Autologin_model->delete_where($where);

        delete_cookie('autologin');

        $this->session->sess_destroy();
        $url_after_logout = $this->cbconfig->item('url_after_logout');
        if ($url_after_logout) {
            $url_after_logout = site_url($url_after_logout);
        }
        if (empty($url_after_logout)) {
            $url_after_logout = $this->input->get_post('url') ? $this->input->get_post('url') : site_url();
        }

        // 이벤트가 존재하면 실행합니다
        Events::trigger('after', $eventname);

        redirect($url_after_logout, 'refresh');
    }


    function findidpw(){

        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_findaccount_index';
        $this->load->event($eventname);

        if ($this->member->is_member() !== false
            && ! (
                $this->member->is_admin() === 'super' && $this->uri->segment(1) === config_item('uri_segment_admin')
            )) {
            redirect();
        }

        $view = array();
        $view['view'] = array();
        $param =& $this->querystring;
        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        $this->load->library(array('form_validation'));

        if ( ! function_exists('password_hash')) {
            $this->load->helper('password');
        }

        $view['view']['login_url']=site_url('login') . '?' .$param->output();
        $view['view']['findidpw_url']=site_url('login/findidpw') . '?' .$param->output();

        /**
         * 전송된 데이터의 유효성을 체크합니다
         */
        $config = array();
        if ($this->input->post('findtype') === 'findid') {
            $config[] = array(
                'field' => 'telnum',
                'label' => 'Phone',
                'rules' => 'trim|required|valid_phone|callback__existphone',
            );
        } elseif ($this->input->post('findtype') === 'findidpw') {
            $config[] = array(
                'field' => 'telnum',
                'label' => 'Phone',
                'rules' => 'trim|required|valid_phone|callback__existphone',
            );
        } 

        $this->form_validation->set_rules($config);
        /**
         * 유효성 검사를 하지 않는 경우, 또는 유효성 검사에 실패한 경우입니다.
         * 즉 글쓰기나 수정 페이지를 보고 있는 경우입니다
         */
        if ($this->form_validation->run() === false) {

            // 이벤트가 존재하면 실행합니다
            $view['view']['event']['formrunfalse'] = Events::trigger('formrunfalse', $eventname);

            if ($this->input->post('returnurl')) {
                if (validation_errors('<div class="alert alert-warning" role="alert">', '</div>')) {
                    $this->session->set_flashdata(
                        'loginvalidationmessage',
                        validation_errors('<div class="alert alert-warning" role="alert">', '</div>')
                    );
                }
                $this->session->set_flashdata(
                    'loginuserid',
                    $this->input->post('mem_userid')
                );
                redirect(urldecode($this->input->post('returnurl')));
            }

        } else {

            // 이벤트가 존재하면 실행합니다
            $view['view']['event']['formruntrue'] = Events::trigger('formruntrue', $eventname);

            if ($this->input->post('findtype') === 'findid') {

                // 이벤트가 존재하면 실행합니다
                $view['view']['event']['findidpw_before'] = Events::trigger('findidpw_before', $eventname);

                $mb = $this->Member_model->get_by_phone($this->input->post('telnum'));
                

                $mem_id = (int) element('mem_id', $mb);
                

                $searchconfig = array(
                    '{홈페이지명}',
                    '{회사명}',
                    '{홈페이지주소}',
                    '{회원아이디}',
                    '{회원닉네임}',
                    '{회원실명}',
                    '{회원이메일}',
                    '{메일수신여부}',
                    '{쪽지수신여부}',
                    '{문자수신여부}',
                    '{회원아이피}',
                    
                );
                $receive_email = element('mem_receive_email', $mb) ? '동의' : '거부';
                $receive_note = element('mem_use_note', $mb) ? '동의' : '거부';
                $receive_sms = element('mem_receive_sms', $mb) ? '동의' : '거부';
                $replaceconfig = array(
                    $this->cbconfig->item('site_title'),
                    $this->cbconfig->item('company_name'),
                    site_url(),
                    element('mem_userid', $mb),
                    element('mem_nickname', $mb),
                    element('mem_username', $mb),
                    element('mem_email', $mb),
                    $receive_email,
                    $receive_note,
                    $receive_sms,
                    $this->input->ip_address(),
                    
                );
                $replaceconfig_escape = array(
                    html_escape($this->cbconfig->item('site_title')),
                    html_escape($this->cbconfig->item('company_name')),
                    site_url(),
                    element('mem_userid', $mb),
                    html_escape(element('mem_nickname', $mb)),
                    html_escape(element('mem_username', $mb)),
                    html_escape(element('mem_email', $mb)),
                    $receive_email,
                    $receive_note,
                    $receive_sms,
                    $this->input->ip_address(),
                    
                );

                $title = str_replace(
                    $searchconfig,
                    $replaceconfig,
                    $this->cbconfig->item('send_email_findid_user_title')
                );
                $content = str_replace(
                    $searchconfig,
                    $replaceconfig_escape,
                    $this->cbconfig->item('send_email_findaccount_user_content')
                );

                $this->email->clear(true);
                $this->email->from($this->cbconfig->item('webmaster_email'), $this->cbconfig->item('webmaster_name'));
                $this->email->to(element('mem_email', $mb));
                $this->email->subject($title);
                $this->email->message($content);
                $this->email->send();

                $view['view']['message'] = '<p>I have sent an ID to the email address you entered when you signed up.</p>';

                // 이벤트가 존재하면 실행합니다
                $view['view']['event']['findidpw_after'] = Events::trigger('findidpw_after', $eventname);

            } elseif ($this->input->post('findtype') === 'findidpw') {

                // 이벤트가 존재하면 실행합니다
                $view['view']['event']['findidpw_before'] = Events::trigger('findidpw_before', $eventname);

                $mb = $this->Member_model->get_by_phone($this->input->post('telnum'));

                $mem_id = (int) element('mem_id', $mb);
                $mae_type = 3;

                $vericode = array('$', '/', '.');
                $verificationcode = str_replace(
                    $vericode,
                    '',
                    password_hash($mem_id . '-' . $this->input->post('telnum') . '-' . random_string('alnum', 10), PASSWORD_BCRYPT)
                );

                $this->load->model('Member_auth_email_model');

                $beforeauthdata = array(
                    'mem_id' => $mem_id,
                    'mae_type' => $mae_type,
                );
                $this->Member_auth_email_model->delete_where($beforeauthdata);
                $authdata = array(
                    'mem_id' => $mem_id,
                    'mae_key' => $verificationcode,
                    'mae_type' => $mae_type,
                    'mae_generate_datetime' => cdate('Y-m-d H:i:s'),
                );
                $this->Member_auth_email_model->insert($authdata);

                $verify_url = site_url('verify/resetpassword?user=' . element('mem_userid', $mb) . '&code=' . $verificationcode);

                $searchconfig = array(
                    '{홈페이지명}',
                    '{회사명}',
                    '{홈페이지주소}',
                    '{회원아이디}',
                    '{회원닉네임}',
                    '{회원실명}',
                    '{회원이메일}',
                    '{메일수신여부}',
                    '{쪽지수신여부}',
                    '{문자수신여부}',
                    '{회원아이피}',
                    '{패스워드변경주소}',
                );
                $receive_email = element('mem_receive_email', $mb) ? '동의' : '거부';
                $receive_note = element('mem_use_note', $mb) ? '동의' : '거부';
                $receive_sms = element('mem_receive_sms', $mb) ? '동의' : '거부';
                $replaceconfig = array(
                    $this->cbconfig->item('site_title'),
                    $this->cbconfig->item('company_name'),
                    site_url(),
                    element('mem_userid', $mb),
                    element('mem_nickname', $mb),
                    element('mem_username', $mb),
                    element('mem_email', $mb),
                    $receive_email,
                    $receive_note,
                    $receive_sms,
                    $this->input->ip_address(),
                    $verify_url,
                );
                $replaceconfig_escape = array(
                    html_escape($this->cbconfig->item('site_title')),
                    html_escape($this->cbconfig->item('company_name')),
                    site_url(),
                    element('mem_userid', $mb),
                    html_escape(element('mem_nickname', $mb)),
                    html_escape(element('mem_username', $mb)),
                    html_escape(element('mem_email', $mb)),
                    $receive_email,
                    $receive_note,
                    $receive_sms,
                    $this->input->ip_address(),
                    $verify_url,
                );

                $title = str_replace(
                    $searchconfig,
                    $replaceconfig,
                    $this->cbconfig->item('send_email_findaccount_user_title')
                );
                $content = str_replace(
                    $searchconfig,
                    $replaceconfig_escape,
                    $this->cbconfig->item('send_email_findaccount_user_content')
                );

                $this->email->clear(true);
                $this->email->from($this->cbconfig->item('webmaster_email'), $this->cbconfig->item('webmaster_name'));
                $this->email->to(element('mem_email', $mb));
                $this->email->subject($title);
                $this->email->message($content);
                $this->email->send();

                $view['view']['message'] = 'Send your encrypted password to your email';

                // 이벤트가 존재하면 실행합니다
                $view['view']['event']['findidpw_after'] = Events::trigger('findidpw_after', $eventname);

                
            }
        }

        
        $view['view']['canonical'] = site_url('login');
        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before_layout'] = Events::trigger('before_layout', $eventname);

        /**
         * 레이아웃을 정의합니다
         */
        $page_title = $this->cbconfig->item('site_meta_title_login');
        $meta_description = $this->cbconfig->item('site_meta_description_login');
        $meta_keywords = $this->cbconfig->item('site_meta_keywords_login');
        $meta_author = $this->cbconfig->item('site_meta_author_login');
        $page_name = $this->cbconfig->item('site_page_name_login');

        $layoutconfig = array(
            'path' => 'login',
            'layout' => 'layout',
            'skin' => 'login',
            'layout_dir' => $this->cbconfig->item('layout_login'),
            'mobile_layout_dir' => $this->cbconfig->item('mobile_layout_login'),
            'use_sidebar' => $this->cbconfig->item('sidebar_login'),
            'use_mobile_sidebar' => $this->cbconfig->item('mobile_sidebar_login'),
            'skin_dir' => $this->cbconfig->item('skin_login'),
            'mobile_skin_dir' => $this->cbconfig->item('mobile_skin_login'),
            'page_title' => $page_title,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
            'meta_author' => $meta_author,
            'page_name' => $page_name,
        );
        $view['layout'] = $this->managelayout->front($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    
    }

    public function _existphone($str)
    {
        
        $str = preg_replace("/[^0-9]*/s", "", $str);
        $userinfo = $this->Member_model
            ->get_by_phone($str, 'mem_id, mem_email, mem_denied, mem_email_cert');
        
        if ( ! element('mem_id', $userinfo)) {
            $this->form_validation->set_message(
                '_existphone',
                'A nonexistent cell phone number'
            );
            return false;
        }
        

        return true;
    }
}
