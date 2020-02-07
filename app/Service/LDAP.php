<?php

namespace App\Service;

class LDAP
{
    public static function authenticate($user, $password) {
        if(empty($user) || empty($password)) return false;
        // active airectory server
        $ldap_host = env('LDAP_HOST');

        // active directory DN (base location of ldap search)
        $ldap_dn = env('LDAP_DN');

        // active directory user group name
        $ldap_user_group = env('LDAP_USER_GROUP');

        // domain, for purposes of constructing $user
        $ldap_dom = env('LDAP_DOM');

        // connect to active directory
        $ldap = ldap_connect($ldap_host);

        // configure ldap params
        ldap_set_option($ldap,LDAP_OPT_PROTOCOL_VERSION,3);
        ldap_set_option($ldap,LDAP_OPT_REFERRALS,0);

        // verify user and password
        if($bind = @ldap_bind($ldap, $user.$ldap_dom, $password)) {
            // valid
            // check presence in groups
            $filter = "(|(sAMAccountName=".$user.")(UserPrincipalName=".$user.$ldap_dom."))";
            $attr = array("memberof");
            $result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
            $entries = ldap_get_entries($ldap, $result);
            ldap_unbind($ldap);

            if(!$entries['count'])
                return false;

            // check groups
            foreach($entries[0]['memberof'] as $grps) {
                // is manager, break loop
                //if(strpos($grps, $ldap_manager_group)) { $access = 2; break; }

                // is user
                if(strpos($grps, $ldap_user_group))
                    return true;
            }  // user has no rights
            return false;

        } else {
            // invalid name or password
            return false;
        }
    }
}

