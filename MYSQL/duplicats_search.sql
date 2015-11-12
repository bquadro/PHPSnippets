SELECT pid, source, url_alias.alias FROM url_alias
INNER JOIN (SELECT alias FROM url_alias
GROUP BY alias HAVING count(pid) > 1) dup ON url_alias.alias = dup.alias